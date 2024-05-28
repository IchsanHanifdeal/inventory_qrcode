<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $data = [
      'labels' => ['January', 'February', 'March', 'April', 'May'],
      'data' => [65, 59, 80, 81, 56],
    ];
    return view('dashboard.index', compact('data'));
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
  public function show(Dashboard $dashboard)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Dashboard $dashboard)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Dashboard $dashboard)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Dashboard $dashboard)
  {
    //
  }
}
