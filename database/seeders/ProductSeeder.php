<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('products')->insert([
                'brand_id' => 5,
                'category_id' => 8,
                'subcategory_id' => 10,
                'subsubcategory_id' => 8,
                'product_name_en' => Str::random(10),
                'product_name_vn' => Str::random(10),
                'product_slug_en' => strtolower(str_replace(' ', '-', Str::random(10))),
                'product_slug_vn' => strtolower(str_replace(' ', '-', Str::random(10))),
                'product_code' => Str::random(10),
                'product_qty' => rand(1, 300),
                'product_tags_en' => "Amet,Round",
                'product_tags_vn' => "Amet,Round",
                'product_size_en' => "Small, Medium, Large",
                'product_size_vn' => "Nhỏ,Trung,Lớn",
                'product_color_en' => 'Red, Black, White',
                'product_color_vn' => 'Đỏ.,Đen,Trắng',
                'discount_price' => rand(1, 200),
                'selling_price' => rand(1, 2000),
                'short_descp_en' => "Alo Contrary to popular belief, Lorem Ipsum is not simply random text.",
                'short_descp_vn' =>  "Alo Trái với suy nghĩ của nhiều người, Lorem Ipsum không chỉ đơn giản là văn bản ngẫu nhiên.",
                'long_descp_en' => "Alo Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.3",
                'long_descp_vn' => "Alo Trái với suy nghĩ của nhiều người, Lorem Ipsum không chỉ đơn giản là văn bản ngẫu nhiên. Nó có nguồn gốc từ một tác phẩm văn học Latinh cổ điển từ năm 45 trước Công nguyên, khiến nó hơn 2000 năm tuổi. Richard McClintock, một giáo sư tiếng Latinh tại Đại học Hampden-Sydney ở Virginia, đã tra cứu một trong những từ Latinh khó hiểu hơn, consectetur, từ một đoạn văn của Lorem Ipsum, và xem qua các trích dẫn của từ này trong văn học cổ điển, đã phát hiện ra nguồn gốc không thể chối cãi. Lorem Ipsum xuất phát từ phần 1.10.32 và 1.10.33 của de Finibus Bonorum et Malorum (Cực đoan của Thiện và Ác) của Cicero, được viết vào năm 45 trước Công nguyên. Cuốn sách này là một chuyên luận về lý thuyết đạo đức, rất phổ biến trong thời kỳ Phục hưng. Dòng đầu tiên của Lorem Ipsum, Lorem ipsum dolor sit amet .., xuất phát từ dòng trong phần 1.10.3",
                'hot_deals' => 1,
                'featured' => 0,
                'product_thumbnail' => 'upload/products/thumbnail/1709996086101013.jpeg',
                'special_offer' => 1,
                'special_deals' => 0,
                'status' => 1,
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
