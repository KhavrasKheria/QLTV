<?php
namespace App\Http\Controllers;

use App\Models\TacGia;
use Illuminate\Http\Request;

class TacGiaController extends Controller
{
    /**
     * Hiển thị danh sách + tìm kiếm
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        
        $tacgias = TacGia::when($keyword, function ($query) use ($keyword) {
            $query->where('TenTG', 'like', "%$keyword%")
                ->orWhere('MaTG', 'like', "%$keyword%");
        })
        ->orderBy('MaTG', 'desc')
        ->get();

        // Nếu là AJAX request thì trả về JSON
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'tacgias' => $tacgias
            ]);
        }

        // Nếu là request thông thường thì trả về view
        return view('tacgia.index', compact('tacgias', 'keyword'));
    }

    /**
     * Form thêm
     */
    public function create()
    {
        return view('tacgia.create');
    }

    /**
     * Lưu tác giả mới
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenTG' => 'required',
        ], [
            'TenTG.required' => 'Vui lòng nhập tên tác giả',
        ]);

        // Tự động tạo mã tác giả
        $maTG = $this->generateMaTG();

        $tacgia = TacGia::create([
            'MaTG' => $maTG,
            'TenTG' => $request->TenTG
        ]);

        // Nếu là AJAX request (từ modal)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thêm tác giả thành công',
                'tacgia' => [
                    'MaTG' => $tacgia->MaTG,
                    'TenTG' => $tacgia->TenTG
                ]
            ]);
        }

        // Nếu là request thông thường
        return redirect()
            ->route('tacgia.index')
            ->with('success', 'Thêm tác giả thành công');
    }

    /**
     * Tạo mã tác giả tự động theo dạng TG_1, TG_2, ...
     */
    private function generateMaTG()
    {
        // Lấy số lớn nhất hiện có
        $lastMaTG = TacGia::where('MaTG', 'like', 'TG_%')
            ->orderByRaw('CAST(SUBSTRING(MaTG, 4) AS UNSIGNED) DESC')
            ->value('MaTG');

        if ($lastMaTG) {
            // Tách số từ mã (TG_10 -> 10)
            $number = (int) substr($lastMaTG, 3);
            $newNumber = $number + 1;
        } else {
            // Nếu chưa có mã nào, bắt đầu từ 1
            $newNumber = 1;
        }

        return 'TG_' . $newNumber;
    }

    /**
     * Form sửa
     */
    public function edit($MaTG)
    {
        $tacgia = TacGia::findOrFail($MaTG);
        return view('tacgia.edit', compact('tacgia'));
    }

    /**
     * Cập nhật tác giả
     */
    public function update(Request $request, $MaTG)
    {
        $request->validate([
            'TenTG' => 'required',
        ], [
            'TenTG.required' => 'Vui lòng nhập tên tác giả',
        ]);

        $tacgia = TacGia::findOrFail($MaTG);
        $tacgia->update([
            'TenTG' => $request->TenTG
        ]);

        return redirect()
            ->route('tacgia.index')
            ->with('success', 'Cập nhật tác giả thành công');
    }

    /**
     * Xóa tác giả
     */
    public function destroy($id)
    {
        try {
            $tacgia = TacGia::findOrFail($id);
            $tacgia->delete();

            return redirect()
                ->route('tacgia.index')
                ->with('success', 'Xóa tác giả thành công!');
        } catch (\Exception $e) {
            return redirect()
                ->route('tacgia.index')
                ->with('error', 'Không thể xóa tác giả. Có thể đang được sử dụng trong sách.');
        }
    }
}