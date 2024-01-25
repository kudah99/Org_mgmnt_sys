<?php

namespace App\Http\Controllers\MemberContribution;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberContributionPostRequest;
use Illuminate\Http\Request;
use App\Models\MemberContribution;
use App\Http\Resources\MemberContributionResource;

class MemberContributionController extends Controller
{
    /**
     * Display the index view with all member contributions.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function view_index(Request $request)
    {
        // Retrieve all member contributions from the database
        $member_contributions = MemberContribution::all();
        
        // Render the 'members.index' view and pass the contributions data to it
        return view('members.index', compact('member_contributions'));
    }

    /**
     * Store a new member contribution in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view_store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'amount' => 'required|numeric|min:0',
            'package' => 'nullable|string'
        ]);

        // Create a new contribution record using Eloquent
        $contribution = new MemberContribution();
        $contribution->member_id = $request->input('member_id');
        $contribution->amount = $request->input('amount');
        $contribution->package = $request->input('package');
        $contribution->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Contribution stored successfully');
    }

    /**
     * Retrieve all member contributions as a JSON resource collection.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        // Return a JSON resource collection of all member contributions
        return MemberContributionResource::collection(MemberContribution::all());
    }

    /**
     * Store a new member contribution in the database and return it as a JSON resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function store(Request $request)
    {
        // Create a new member contribution using Eloquent mass assignment
        $memberContribution = MemberContribution::create($request->all());

        // Return the new contribution as a JSON resource
        return new MemberContributionResource($memberContribution);
    }

    /**
     * Retrieve a specific member contribution by its ID as a JSON resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show($id)
    {
        // Find the member contribution by its ID and return it as a JSON resource
        return new MemberContributionResource(MemberContribution::findOrFail($id));
    }

    /**
     * Update an existing member contribution in the database and return it as a JSON resource.
     *
     * @param MemberContributionPostRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(MemberContributionPostRequest $request, $id)
    {
        // Find the member contribution by its ID
        $memberContribution = MemberContribution::findOrFail($id);
        
        // Update the contribution with the specified fields from the request
        $memberContribution->update($request->only("amount", "package"));
        
        // Return the updated contribution as a JSON resource
        return new MemberContributionResource($memberContribution);
    }

    /**
     * Delete a member contribution from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Find and delete the member contribution by its ID
        MemberContribution::findOrFail($id)->delete();

        // Return a JSON response indicating success
        return response()->json([
            "data" => [
                "success" => true
            ]
        ]);
    }
}
