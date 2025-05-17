<?php

namespace App\Http\Controllers\Admin\Kontak;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class DashboardKontakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.feedback.index', [
            'title' => 'Kritik & Saran',
            'feedback' => Feedback::all(),
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $kontak)
    {
        $kontak->delete();

        return redirect('/dashboard/kontak')->with('success', 'Data berhasil dihapus!');
    }
}
