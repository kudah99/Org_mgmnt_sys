<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Resources\MemberResource;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display the index view with a list of members based on search criteria.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function view_index(Request $request)
    {
        // Get the search term from the request
        $search = $request->input('search');

        // Search for members based on multiple fields
        $members = Member::where('first_name', 'LIKE', "%$search%")
            ->orWhere('last_name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('phone_number', 'LIKE', "%$search%")
            ->orWhere('address', 'LIKE', "%$search%")
            ->orWhere('gender', 'LIKE', "%$search%")
            ->get();

        // Pass the found members to the 'members.index' view
        return view('members.index', compact('members'));
    }

    /**
     * Store a new member in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view_store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:members|max:255',
            'phone_number' => 'nullable|string|max:20',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'required|in:male,female',
        ]);

        // Create a new member record using Eloquent
        $member = new Member();
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->email = $request->input('email');
        $member->phone_number = $request->input('phone_number');
        $member->address = $request->input('address');
        $member->gender = $request->input('gender');
        $member->save();

        // Additional logic (e.g., sending confirmation email) can be added here

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Member added successfully!');
    }

    /**
     * Retrieve all members as a JSON resource collection.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        // Return a JSON resource collection of all members
        return MemberResource::collection(Member::all());
    }

    /**
     * Store a new member in the database and return it as a JSON resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        // Create a new member using Eloquent mass assignment
        $member = Member::create($request->all());

        // Return the new member as a JSON resource
        return new MemberResource($member);
    }

    /**
     * Retrieve a specific member by its ID as a JSON resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        // Find the member by its ID and return it as a JSON resource
        return new MemberResource(Member::findOrFail($id));
    }

    /**
     * Update an existing member in the database and return it as a JSON resource.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id)
    {
        // Find the member by its ID
        $member = Member::findOrFail($id);

        // Update the member with the specified fields from the request
        $member->update($request->only("amount", "package"));

        // Return the updated member as a JSON resource
        return new MemberResource($member);
    }

    /**
     * Delete a member from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find and delete the member by its ID
        Member::findOrFail($id)->delete();

        // Return a JSON response indicating success
        return response()->json([
            "data" => [
                "success" => true
            ]
        ]);
    }
}
