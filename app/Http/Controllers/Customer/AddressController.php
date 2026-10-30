<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    
// Save a new address
    public function store(Request $request)
    {
        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'recipient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address_line' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        DB::transaction(function () use ($validated, $user, $request) {
            $isFirstAddress = !$user->addresses()->exists();
            $makeDefault = $request->boolean('is_default') || $isFirstAddress;

            if ($makeDefault) {
                $user->addresses()->update(['is_default' => false]);
            }

            $user->addresses()->create([
                ...$validated,
                'is_default' => $makeDefault,
            ]);
        });

        return back()->with('success', 'Address saved successfully.');
    }

    // Delete an address belonging to the logged-in user
    public function destroy(Address $address)
    {
        abort_unless($address->user_id === Auth::id(), 403);

        $wasDefault = $address->is_default;
        $user = Auth::user();

        $address->delete();

        if ($wasDefault) {
            $nextAddress = $user->addresses()->first();

            if ($nextAddress) {
                $nextAddress->update(['is_default' => true]);
            }
        }

        return back()->with('success', 'Address deleted successfully.');
    }

    // Set an address as default
    public function setDefault(Address $address)
    {
        abort_unless($address->user_id === Auth::id(), 403);

        DB::transaction(function () use ($address) {
            $address->user->addresses()->update(['is_default' => false]);
            $address->update(['is_default' => true]);
        });

        return back()->with('success', 'Default address updated.');
    }
}
