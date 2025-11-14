<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class AdminCategoryController extends Controller
{
    // Danh sách các khóa danh mục mà Admin có thể quản lý
    private $keys = [
        'category' => 'Ngành Nghề/Lĩnh Vực',
        'location' => 'Địa Điểm/Khu Vực',
        'level' => 'Cấp Bậc',
        'experience' => 'Kinh Nghiệm',
        'degree' => 'Bằng Cấp',
        'gender' => 'Giới Tính',
        'remote_type' => 'Hình Thức Làm Việc',
    ];

    /**
     * [GET] Hiển thị danh sách các danh mục theo Key (Trang Index).
     */
    public function index($key)
    {
        if (!array_key_exists($key, $this->keys)) {
            abort(404, 'Danh mục không tồn tại.');
        }

        $title = $this->keys[$key];
        $categories = Category::where('key', $key)->orderBy('order', 'asc')->get();
        $keys = $this->keys; // Truyền cho Modal Thêm Mới

        return view('admin.categories.index', compact('categories', 'key', 'title', 'keys'));
    }

    /**
     * [GET] Hiển thị form độc lập để tạo mới danh mục (Trang Create).
     */
    public function create()
    {
        $keys = $this->keys; 
        return view('admin.categories.create_page', compact('keys'));
    }
    
    /**
     * [POST] Lưu giá trị danh mục mới HOẶC cập nhật giá trị đã có.
     */
    public function store(Request $request)
    {
        $categoryId = $request->input('category_id'); 
        
        $request->validate([
            'key' => ['required', 'string', Rule::in(array_keys($this->keys))],
            'value' => [
                'required', 
                'string', 
                'max:255',
                // Đảm bảo giá trị là duy nhất trong cùng một loại (key)
                Rule::unique('categories')->where(function ($query) use ($request, $categoryId) {
                    return $query->where('key', $request->key)->where('id', '!=', $categoryId);
                }),
            ],
            'category_id' => 'nullable|exists:categories,id', // Dùng cho Update
            'order' => 'nullable|integer|min:0',
        ]);

        if ($request->filled('category_id')) {
            // Cập nhật (Update)
            $category = Category::findOrFail($request->category_id);
            $category->update($request->only('value', 'order'));
            $message = 'Danh mục đã được cập nhật thành công!';
        } else {
            // Tạo mới (Create)
            Category::create($request->only('key', 'value', 'order'));
            $message = 'Danh mục mới đã được thêm thành công!';
        }

        // Dùng redirect()->back() để giữ ngữ cảnh của trang index hiện tại (nếu dùng modal)
        return redirect()->back()->with('success', $message);
    }
    
    /**
     * [DELETE] Xóa một danh mục.
     */
    public function destroy(Category $category)
    {
        $key = $category->key; 
        $category->delete();

        return redirect()->route('admin.category.index', $key)->with('success', 'Danh mục đã được xóa thành công!');
    }
}