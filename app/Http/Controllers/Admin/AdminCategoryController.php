<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
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
     * Cập nhật một danh mục hiện có.
     */
    public function update(Request $request, Category $category)
    {
        // 1. Validation
        // Lấy category_id từ input ẩn (đã được thêm vào edit_modal)
        $categoryId = $request->input('category_id'); 
        
        // Loại trừ category hiện tại khỏi ràng buộc unique (unique:categories,value,id)
        $validated = $request->validate([
            'value' => [
                'required',
                'string',
                'max:255',
                // Đảm bảo không có 2 giá trị cùng KEY và cùng VALUE (ngoại trừ chính nó)
                Rule::unique('categories')->where(function ($query) use ($category) {
                    return $query->where('key', $category->key);
                })->ignore($category->id),
            ],
            'order' => 'nullable|integer|min:0',
        ]);
        
        // 2. Cập nhật dữ liệu
        try {
            $category->update([
                'value' => $validated['value'],
                'order' => $validated['order'] ?? 0, // Đảm bảo order không phải null nếu rỗng
            ]);
            
            // 3. Chuyển hướng thành công
            return redirect()->route('admin.categories.index', $category->key)
                             ->with('success', "Cập nhật danh mục '{$category->value}' thành công!");

        } catch (\Exception $e) {
            // 4. Xử lý lỗi
            // Nếu có lỗi, chuyển hướng về modal sửa lỗi (dùng old('category_id') để script tự mở modal)
            return redirect()->back()
                             ->withInput(['category_id' => $category->id, 'key' => $category->key]) 
                             ->withErrors(['value' => 'Lỗi không xác định khi cập nhật.'])
                             ->with('error', 'Không thể cập nhật danh mục: ' . $e->getMessage());
        }
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

        // Kiểm tra xem ID của Category này có đang được sử dụng trong BẤT KỲ cột khóa ngoại nào trong bảng Jobs không
        $jobCount = Job::where('category_id', $category->id)
            ->orWhere('location_id', $category->id)
            ->orWhere('level_id', $category->id)
            ->orWhere('experience_id', $category->id)
            ->orWhere('degree_id', $category->id)
            ->orWhere('gender_id', $category->id)
            ->orWhere('remote_type_id', $category->id)
            ->count();

        if ($jobCount > 0) { 
            // 1. Gửi thông báo LỖI với key 'error'
            return redirect()->back()->with('error', 
                'Không thể xóa danh mục "' . $category->value . '" vì nó đang được sử dụng bởi ' . $jobCount . ' tin tuyển dụng. Vui lòng cập nhật các tin tuyển dụng đó trước.'
            );
        }
        
        // 2. Nếu không có Jobs nào liên quan, tiến hành xóa
        try {
            $category->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi không xác định khi xóa: ' . $e->getMessage());
        }

        // 3. Chuyển hướng thành công
        return redirect()->route('admin.categories.index', $key)->with('success', 
            "Danh mục '{$category->value}' đã được xóa thành công!"
        );
    }
}