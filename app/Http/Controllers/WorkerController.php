<?php

namespace App\Http\Controllers;

use App\Models\Depertment;
use App\Models\Guardian;
use App\Models\User;
use App\Models\UserPhone;
use App\Models\Worker;
use App\Models\WorkerDepertment;
use Illuminate\Http\Request;
use App\Traits\SaveGuardian;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    use SaveGuardian, SoftDeletes;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.worker.index',['workers' => Worker::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.resource.worker.crud.create',['depertments' => Depertment::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, UserPhone $user_phone, Guardian $guardian)
    {
        $request->validate([
            'first_name' => 'required',
            'sur_name' => 'required',
            'depertment_id' =>'required',
            'address' => 'required',
            //'location' => 'required'
        ]);

        // Save to guardian
        $this->password = Hash::make('password');
        $this->saveGuardian($request, true);

        //create password
        // if (!is_null($user->find($this->user_id)->email)) {
        //     $this->updateUser($this->user_id, ['password' => Hash::make('password')]);
        //     //send Email to this user;
        // }

        //Store to worker table
        $worker_id = Worker::create(array_merge(['guardian_id' => $this->guardian_id, 'joined' => date('Y-m-d')]))->id;

        //Add depertment
        WorkerDepertment::create(array_merge(['worker_id' => $worker_id, 'from' => date('Y-m-d')], $request->only('depertment_id')));

        //return to route worker.index
        return redirect(route('workers.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        return view('app.resource.worker.crud.edit', ['worker' => $worker, 'depertments' =>Depertment::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'first_name' => 'required',
            'sur_name' => 'required',
            'depertment_id' =>'required',
            'address' => 'required',
            //'location' => 'required'
        ]);

        //Updating user
        User::find($request->user)->update($request->only(['first_name', 'second_name', 'sur_name', 'gender', 'email']));

        //Updating guardian
        Guardian::find($request->guardian)->update($request->only(['address']));

        //updating worker depert
        WorkerDepertment::find($request->depertment)->update($request->only(['depertment_id']));

        //updating Worker kama worker
        $worker->update($request->only(['joined']));

        //return to route worker.index
        return redirect(route('workers.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->update(['to' => date('Y-m-d')]);
        WorkerDepertment::where('worker_id', $worker->id)->update(['to' => date('Y-m-d')]);

        $worker->delete();
        return redirect(route('workers.index'));
    }
}
