<?php
namespace Huang\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class ContactController extends Controller
{
	public function index()
	{
		// dd(Config::get("contact.message"));
		return view('contact::contact');
	}
}