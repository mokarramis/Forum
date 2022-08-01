<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTreadRequest;
use App\Http\Requests\DestroyThreadRequest;
use App\Http\Requests\ShowThreadRequest;
use App\Http\Resources\showThreadResource;
use App\Http\Resources\ThreadResource;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class TreadController extends Controller
{
    
    public function index(){
        $threads = Thread::query();

        $by = request('by');
        $unanswered = request('unanswered');
        $popular = request('popular');
        if( $by ){
            $username = $by;
            $user = User::where('name', $username)->findOrFail();
            $threads = Thread::where('user_id', $user->id)->latest();
        } elseif( $popular ){
            $threads = Thread::orderBy('replies_count', 'desc');
        } elseif( $unanswered ){
            $threads = Thread::where('replies_count', 0)->latest();
        }else {
            $threads = $threads->latest();
        }
        $threads = $threads->paginate(10);
        return ThreadResource::collection($threads);
    }

    public function create(CreateTreadRequest $request){
        $user = auth()->user();
        //dd($user);
        Thread::create([
            'user_id' => $user->id,
            'channel_id' => $request->channel_id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        return [
            'status' => true,
            'message' => trans('api.thread.create_success')
        ];

    }

    public function show(Thread $thread){
        
        return new showThreadResource($thread);
    }

    public function destroy(DestroyThreadRequest $request){
        $thread = Thread::find($request->thread_id);
        
        $this->authorize('update', $thread);
        $thread->delete();
        return [
            'status' => true,
            'message' => trans('api.thread.destroy_success')
        ];

    }

}
