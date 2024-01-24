<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Http\Resources\MemberResource;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function view_index(Request $request)
    {
        $search = $request->input('search');

        $members = Member::where('first_name', 'LIKE', "%$search%")
            ->orWhere('last_name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('phone_number', 'LIKE', "%$search%")
            ->orWhere('address', 'LIKE', "%$search%")
            ->orWhere('gender', 'LIKE', "%$search%")
            ->get();
        return view('members.index', compact('members'));
    }

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

        $member = new Member();
        $member->first_name = $request->input('first_name');
        $member->last_name = $request->input('last_name');
        $member->email = $request->input('email');
        $member->phone_number = $request->input('phone_number');
        $member->address = $request->input('address');
        $member->gender = $request->input('gender');
        $member->save();

        // You can add any additional logic here, such as sending a confirmation email

        // Redirect back or to a success page
        return redirect()->back()->with('success', 'Member added successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return MemberResource::collection(Member::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  Member $member

     */
    public function show(Member $member)
    {
        return new MemberResource($member);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
   return response()->json(null,204);
    }
}
