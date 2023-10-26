<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Storage;

class ListingController extends Controller
{
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(4),
        ]);
    }
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }
    public function dashboard(Listing $listing)
    {
        return view('listings.dashboard', [
            'listings' => auth()->user()->listings()->paginate(4)
        ]);
    }
    public function create()
    {
        return view('listings.create');
    }

    public function edit(Listing $listing)
    {


        return view('listings.edit', [
            'listing' => $listing
        ]);
    }
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "company" => "required|unique:listings,company|string",
            "title" => "required|string",
            "location" => "required|string",
            "email" => "required|email|unique:listings,email",
            "website" => "required|url",
            "tags" => "required|string",
            "description" => "required|string",
        ]);

        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        // add the user id field to the table
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        return redirect('/')->with("message", "Listing created successfully!");
    }
    public function update(Request $request, Listing $listing)
    {
        // make sure listing belongs to the user
        if ($listing->user_id != auth()->id()) {
            abort(403, 'User not authorized');
        }

        $formFields = $request->validate([
            "company" => "required|string",
            "title" => "required|string",
            "location" => "required|string",
            "email" => "required|email",
            "website" => "required|url",
            "tags" => "required|string",
            "description" => "required|string",
        ]);

        if ($request->hasFile('logo')) {
            if (Storage::exists('public/' . $listing->logo)) {
                Storage::delete('public/' . $listing->logo);
            }
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
        return back()->with("message", "Listing created successfully!");

    }
    public function destroy(Listing $listing)
    {
        // make sure listing belongs to the user
        if ($listing->user_id != auth()->id()) {
            abort(403, 'User not authorized');
        }

        if (Storage::exists('public/' . $listing->logo)) {
            Storage::delete('public/' . $listing->logo);
        }
        $listing->delete();
        return redirect('/')->with("message", "Listing deleted successfully!");
    }
}