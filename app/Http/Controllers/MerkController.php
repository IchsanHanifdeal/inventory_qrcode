<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return view('dashboard.merk');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Merk $merk)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Merk $merk)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Merk $merk)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Merk $merk)
  {
    //
  }
}
