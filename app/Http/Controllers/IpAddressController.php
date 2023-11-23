<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\Comment;
use App\Models\IpAdress;
use App\Models\PhotoTask;
use App\Models\Task;
use Illuminate\Http\Request;    use Illuminate\Support\Facades\Storage;


class IpAddressController extends Controller
{
    public function index()
    {
        $ids = IpAdress::all();
        return view ('task.ipad' ,['ids' => $ids]);
    }
    public function create()
    {

    }

    public function store(Request $request)
    {

    }


    public function show(Comment $comment)
    {
        //
    }
    public function edit($id)
    {

    }
    public function update(Request $request, $id)
    {

    }

    public function destroy(string $id)
    {

    }
}
