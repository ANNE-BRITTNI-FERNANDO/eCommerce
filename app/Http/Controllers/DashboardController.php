<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class DashboardController extends Controller
{
// In your controller (e.g., DashboardController.php)
public function index()
{
    // Fetch chats where the logged-in user is either the seller or the buyer
    $chats = Chat::where('seller_id', auth()->id())
                 ->orWhere('buyer_id', auth()->id()) // Add condition to fetch buyer's chats as well
                 ->with('product', 'messages') // Eager load product and messages
                 ->get();

    return view('dashboard.index', compact('chats'));
}


    
}
