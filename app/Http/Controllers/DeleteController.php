<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Jenis;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function destroy($type, $id)
    {
        try {
            DB::beginTransaction();

            switch ($type) {
                case 'barang':
                    $model = Barang::where('id_barang', $id)->firstOrFail();
                    break;
                case 'user':
                    $model = User::where('id_user', $id)->firstOrFail();
                    break;
                case 'merk':
                    $model = Merk::where('id_merk', $id)->firstOrFail();
                    break;
                case 'jenis':
                    $model = Jenis::where('id_jenis', $id)->firstOrFail();
                    break;
                default:
                    return redirect()->back()->with('error', 'Invalid type');
            }

            $model->delete();

            DB::commit();

            return redirect()->back()->with('success', ucfirst($type) . ' berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus ' . $type . ': ' . $e->getMessage());
        }
    }
}
