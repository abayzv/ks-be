<?php

namespace App\Http\Controllers;

use App\Http\Resources\QueueResource;
use App\Models\Queue;
use Illuminate\Http\Request;
use Carbon\Carbon;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $lastQueue = Queue::latest()->first();
        $lastDate = $lastQueue->created_at->format('d/m/Y');
        $thisDate = Carbon::now()->format('d/m/Y');
        if ($lastDate != $thisDate) {
            $start_queue = 1;
        } else {
            $start_queue = $lastQueue->queue_number + 1;
        }
        return ["start_queue" => $start_queue, "data" => QueueResource::collection(Queue::latest()->get())];
    }

    public function setStatus(Request $request)
    {
        if ($request->status == "process") {
            $queue = Queue::get();
            $numberOfProcess = 0;
            foreach ($queue as $key => $value) {
                if ($value['status'] == "process") {
                    $numberOfProcess = $numberOfProcess + 1;
                }
            }
            if ($numberOfProcess < 4) {
                $queue = Queue::find($request->id);
                $queue->status = $request->status;
                $queue->save();
                return response([
                    "message" => "Nomor Antrian diproses"
                ], 200);
            } else {
                return response([
                    "message" => "Antrian Penuh"
                ], 401);
            }
        } else {
            $queue = Queue::find($request->id);
            $queue->status = $request->status;
            $queue->save();
            return response([
                "message" => "Berhasil"
            ], 200);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'mechanic_id' => 'required',
            'vehicle_id' => 'required',
            'service_id' => 'required',
        ], [
            'customer_id.required' => 'Customer tidak boleh kosong',
            'mechanic_id.required' => 'Mekanik tidak boleh kosong',
            'vehicle_id.required' => 'Motor tidak boleh kosong',
            'service_id.required' => 'Service tidak boleh kosong',
        ]);
        if ($validated) {
            $data = [
                'customer_id' => (int)$request->customer_id,
                'mechanic_id' => (int)$request->mechanic_id,
                'vehicle_id' => (int)$request->vehicle_id,
                'service_id' => (int)$request->service_id,
                'status' => "pending",
                'queue_number' => (int)$request->number,
            ];
            $queue = Queue::create($data);
            return json_encode($queue);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queue $queue)
    {
        //
    }
}
