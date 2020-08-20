<?php

namespace App\Repositories;

use Auth;
use App\User;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Zofe\Rapyd\Facades\DataGrid;
use Zofe\Rapyd\Facades\DataEdit;

class CrudRepository
{
    protected $brand;

    protected $category;

    protected $product;

    protected $order;

    /**
     * @param Brand $brand
     * @param Category $category
     * @param Order $order
     * @param Product $product
     */
    public function __construct
    (
        Brand $brand,
        Category $category,
        Order $order,
        Product $product
    )
    {
        $this->brand = $brand;
        $this->category = $category;
        $this->product = $product;
        $this->order = $order;
    }

    /**
     * Crud for Brand table.
     * @return mixed
     */
    public function brandsFilter()
    {
        $filter = \DataFilter::source(new Brand());
        $filter->add('brand_id', 'ID', 'text')->clause('where')->operator('=');
        $filter->add('brand', 'Brand', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }

    /**
     * Crud for Brand table.
     * @return mixed
     */
    public function brandsGrid()
    {
        $grid = DataGrid::source($this->brandsFilter());
        $grid->label('Brands');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('brand_id', 'ID', true)->style("width:100px");
        $grid->add('brand', 'Brand');
        $grid->edit('/backend/brands/edit');
        $grid->link('/backend/brands/edit', "New Brand", "TR");
        $grid->orderBy('brand_id', 'asc');
        $grid->paginate(5);
        return $grid;
    }

    /**
     * Crud for Brand table.
     * @return mixed
     */
    public function brandsEdit()
    {
        $edit = DataEdit::source(new Brand());
        $edit->add('brand', 'Brand', 'text');
        $edit->link('/backend/brands', "Back", "TR");
        return $edit;
    }

    /**
     * Get table name.
     * @return mixed
     */
    public function getBrandTable()
    {
        return $table = with(new Brand())->getTable();
    }

    /**
     * @return mixed
     */
    public function catFilter()
    {
        $filter = \DataFilter::source(new Category());
        $filter->add('cat_id', 'ID', 'text')->clause('where')->operator('=');
        $filter->add('cat', 'Category', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }

    /**
     * Crud for Main category table.
     * @return mixed
     */
    public function catGrid()
    {
        if (request()->segment(2) === 'subcategory') {
            $grid = DataGrid::source(Category::with('parent')->where('parent_id','>', 0));
            $grid->label('Subcategory');
            $grid->attributes(array("class" => "table table-striped"));
            $grid->add('cat_id', 'ID', true)->style("width:100px");
            $grid->add('cat', 'Subategory');
            $grid->add('{{ $parent->cat }}','Parent', 'cat_id');
            $grid->edit('/backend/subcategory/edit');
            $grid->link('/backend/subcategory/edit', "New Subategory", "TR");
        } else {
            $grid = DataGrid::source($this->category->where('parent_id', 0));
            $grid->label('Main category');
            $grid->attributes(array("class" => "table table-striped"));
            $grid->add('cat_id', 'ID', true)->style("width:100px");
            $grid->add('cat', 'Category');
            $grid->edit('/backend/category/edit');
            $grid->link('/backend/category/edit', "New Main Category", "TR");
        }
        $grid->orderBy('cat_id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    /**
     * Edit Main Categories
     * @return mixed
     */
    public function catEdit()
    {
        if(request()->segment(2) === 'subcategory'){
            $edit = DataEdit::source(new Category());
            $edit->label('Edit Subategory');
            $edit->add('cat_id', 'ID', 'text');
            $edit->add('cat', 'Subategory', 'select')->options($this->category->where('parent_id','>', 0)->pluck("cat", "cat")->all());
            $edit->add('parent.cat', 'Parent', 'select')->options($this->category->where('parent_id',0)->pluck("cat", "cat_id")->all());
            $edit->link('/backend/subcategory', "Back", "TR");

        }else{
            $edit = DataEdit::source(new Category());
            $edit->label('Edit Main Category');
            $edit->add('cat_id', 'ID', 'text');
            $edit->set('parent_id', 0);
            $edit->add('cat', 'Category', 'text');
            $edit->link('/backend/category', "Back", "TR");

        }
        return $edit;
    }

    /**
     * Get name of the table.
     * @return mixed
     */
    public function getCatTable()
    {
        return $table = with(new Category())->getTable();
    }


    /**
     * Search for Product table.
     * @return mixed
     */
    public function productsFilter()
    {
        $filter = \DataFilter::source($this->product->with('brands', 'size', 'color', 'category'));
        $filter->add('product_id', 'ID', 'text');
        $filter->add('name', 'Name', 'text');
        $filter->add('brands.brand', 'Brand', 'text');
        $filter->add('category.cat', 'Category', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }

    /**
     * Crud for Product table.
     * @return mixed
     */
    public function productsGrid()
    {
        $grid = DataGrid::source($this->productsFilter());
        $grid->label('Product List');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('slug', 'Slug');
        $grid->add('name', 'Name');
        $grid->add('brands.brand', 'Brand');
        $grid->add('category.cat', 'Category');
        $grid->add('category.parent_id','Parent Category');
        $grid->add('{{ implode(", ", $size->pluck("size")->all()) }}', 'Sizes');
        $grid->add('{{ implode(", ", $color->pluck("color")->all()) }}', 'Colors');
        $grid->add('<img src="/images/products/{{ $a_img }}" height="25" width="20">', 'Front');
        $grid->add('<img src="/images/products/{{ $b_img }}"height="25" width="20">', 'Side');
        $grid->add('quantity', 'Qty');
        $grid->add('price', 'Price');
        $grid->edit('/backend/products/edit');
        $grid->link('/backend/products/edit', "New Products", "TR");
        $grid->orderBy('id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    /**
     * Crud for Product table.
     * @return mixed
     */
    public function productsEdit()
    {
        $edit = DataEdit::source(new Product());
        $edit->label('Edit Product');
        $edit->add('slug', 'Slug', 'text')->rule('required|min:3');
        $edit->add('name', 'Name', 'text')->rule('required|min:3');
        $edit->add('description', 'Description', 'redactor');
        $edit->add('brand_id', 'Brand', 'select')->options($this->brand->pluck("brand", "brand_id")->all());
        $edit->add('cat_id', 'Category', 'select')->options($this->category->where('parent_id','>',0)->pluck("cat", "cat_id")->all());
        $edit->add('parent_id', 'Parent Category', 'select')->options($this->category->where('parent_id',0)->pluck("cat", "cat_id")->all());;
        $edit->add('size.size', 'Size', 'tags');
        $edit->add('color.color', 'Color', 'tags');
        $edit->add('a_img', 'Front', 'image')->move('images/products/')->fit(370, 507)->preview(120, 80);
        $edit->add('b_img', 'Side', 'image')->move('images/products/')->fit(370, 507)->preview(120, 80);
        $edit->add('quantity', 'Qty', 'text');
        $edit->add('price', 'Price', 'text');
        $edit->link('/backend/products', "Back", "TR");
        return $edit;
    }

    /**
     * Get name of the table.
     * @return mixed
     */
    public function getProductTable()
    {
        return $table = with(new Product())->getTable();
    }

    /**
     * Profile user
     * @return mixed
     */
    public function profileGrid()
    {
        $id = Auth::user()->id;
        $grid = DataGrid::source(User::where('id', $id));
        $grid->label('Your Profile');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('name', 'Name');
        $grid->add('<img src="/images/avatars/{{ $avatar }}" height="25" width="25">', 'Avatar');
        $grid->add('email', 'Email');
        $grid->edit('/backend/profile/edit', 'Edit', 'show|modify');
        $grid->orderBy('id', 'asc');
        return $grid;
    }

    /**
     * Edit Profile
     * @return mixed
     */
    public function profileEdit()
    {
        $edit = DataEdit::source(new User());
        $edit->label('Edit Profile');
        $edit->add('avatar', 'Avatar', 'image')->move('images/avatars/')->fit(240, 160)->preview(120, 80);
        $edit->link('/backend/profile', "Back", "TR");
        return $edit;
    }

    /**
     * Crud for Order table.
     * @return mixed
     */
    public function ordersFilter()
    {
        $filter = \DataFilter::source($this->order->with('users', 'products'));
        $filter->add('id', 'ID', 'text')->clause('where')->operator('=');
        $filter->add('users.name', 'Customer', 'text');
        $filter->add('products.name', 'Product', 'text');
        $filter->add('size', 'Size', 'text');
        $filter->add('color', 'Color', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }


    /**
     * Crud for Products table.
     * @return mixed
     */
    public function ordersGrid()
    {
        $grid = DataGrid::source($this->ordersFilter());
        $grid->label('Total Orders');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('users.name', 'Customer', 'text');
        $grid->add('order_date', 'Date');
        $grid->add('<a href="/backend/products/edit?show={{ $products->product_id }}">{{ $products->name }}</a>', 'Product');
        $grid->add('size', 'Size');
        $grid->add('<img src="/images/products/{{ $img }}" height="25" width="25">', 'Image');
        $grid->add('color', 'Color');
        $grid->add('quantity', 'Qty');
        $grid->add('amount', 'Amount');
        $grid->edit('/backend/orders/edit');
        $grid->link('/backend/orders/edit', "TR");
        $grid->orderBy('id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    /**
     * Get table name.
     * @return mixed
     */
    public function getOrderTable()
    {
        return $table = with(new Order())->getTable();
    }

    public function weeklyOrdersFilter()
    {
        $date = \Carbon\Carbon::today()->subDays(7)->format('Y-m-d')." 00:00:00";
        $filter = \DataFilter::source($this->order->with('users', 'products')->whereRaw('order_date >='."'".$date. "'" ));
        $filter->add('id', 'ID', 'text')->clause('where')->operator('=');
        $filter->add('users.name', 'Customer', 'text');
        $filter->add('products.name', 'Product', 'text');
        $filter->add('size', 'Size', 'text');
        $filter->add('color', 'Color', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }

    public function weeklyOrdersGrid()
    {
        $grid = DataGrid::source($this->weeklyOrdersFilter());
        $grid->label('Total Orders');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('users.name', 'Customer', 'text');
        $grid->add('order_date', 'Date');
        $grid->add('<a href="/backend/products/edit?show={{ $products->product_id }}">{{ $products->name }}</a>', 'Product');
        $grid->add('size', 'Size');
        $grid->add('<img src="/images/products/{{ $img }}" height="25" width="25">', 'Image');
        $grid->add('color', 'Color');
        $grid->add('quantity', 'Qty');
        $grid->add('amount', 'Amount');
        $grid->edit('/backend/orders/edit');
        $grid->link('/backend/orders/edit', "TR");
        $grid->orderBy('id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    public function getWeeklyOrderTable()
    {
        return $table = with(new Order())->getTable();
    }

    public function monthlyOrdersFilter()
    {
        $date = \Carbon\Carbon::today()->subDays(30)->format('Y-m-d')." 00:00:00";
        $filter = \DataFilter::source($this->order->with('users', 'products')->whereRaw('order_date >='."'".$date. "'" ));
        $filter->add('id', 'ID', 'text')->clause('where')->operator('=');
        $filter->add('users.name', 'Customer', 'text');
        $filter->add('products.name', 'Product', 'text');
        $filter->add('size', 'Size', 'text');
        $filter->add('color', 'Color', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }

    public function monthlyOrdersGrid()
    {   
        $grid = DataGrid::source($this->monthlyOrdersFilter());
        $grid->label('Total Orders');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('users.name', 'Customer', 'text');
        $grid->add('order_date', 'Date');
        $grid->add('<a href="/backend/products/edit?show={{ $products->product_id }}">{{ $products->name }}</a>', 'Product');
        $grid->add('size', 'Size');
        $grid->add('<img src="/images/products/{{ $img }}" height="25" width="25">', 'Image');
        $grid->add('color', 'Color');
        $grid->add('quantity', 'Qty');
        $grid->add('amount', 'Amount');
        $grid->edit('/backend/orders/edit');
        $grid->link('/backend/orders/edit', "TR");
        $grid->orderBy('id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    public function getMonthlyOrderTable()
    {
        return $table = with(new Order())->getTable();
    }

    public function dailyOrdersFilter()
    {
        $date = \Carbon\Carbon::today()->format('Y-m-d')." 00:00:00";
        $filter = \DataFilter::source($this->order->with('users', 'products')->whereRaw('order_date >='."'".$date. "'" ));
        $filter->add('id', 'ID', 'text')->clause('where')->operator('=');
        $filter->add('users.name', 'Customer', 'text');
        $filter->add('products.name', 'Product', 'text');
        $filter->add('size', 'Size', 'text');
        $filter->add('color', 'Color', 'text');
        $filter->submit('search');
        $filter->reset('reset');
        $filter->build();
        return $filter;
    }

    public function dailyOrdersGrid()
    {
        $grid = DataGrid::source($this->dailyOrdersFilter());
        $grid->label('Total Orders');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('users.name', 'Customer', 'text');
        $grid->add('order_date', 'Date');
        $grid->add('<a href="/backend/products/edit?show={{ $products->product_id }}">{{ $products->name }}</a>', 'Product');
        $grid->add('size', 'Size');
        $grid->add('<img src="/images/products/{{ $img }}" height="25" width="25">', 'Image');
        $grid->add('color', 'Color');
        $grid->add('quantity', 'Qty');
        $grid->add('amount', 'Amount');
        $grid->edit('/backend/orders/edit');
        $grid->link('/backend/orders/edit', "TR");
        $grid->orderBy('id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    public function getDailyOrderTable()
    {
        return $table = with(new Order())->getTable();
    }

    /**
     * Crud for Order table.
     * @return mixed
     */
    public function ordersEdit()
    {
        $edit = DataEdit::source(new Order());
        $edit->label('Edit Order');
        $edit->add('users.name', 'Username', 'text');
        $edit->add('order_date', 'Date', 'text');
        $edit->add('products.name', 'Product', 'text');
        $edit->add('size', 'Size', 'text');
        $edit->add('img', 'Image', 'image')->move('images/products/')->fit(240, 160)->preview(120, 80);
        $edit->add('color', 'Color', 'text');
        $edit->add('quantity', 'Qty', 'text');
        $edit->add('amount', 'Amount', 'text');
        $edit->link('/backend/orders', "Back", "TR");
        return $edit;
    }

    /**
     * Crud for user order.
     * @return mixed
     */
    public function UserOrdersGrid()
    {
        $id = Auth::user()->id;
        $grid = DataGrid::source($this->order->with('products')->where('user_id', $id));
        $grid->label('My Orders');
        $grid->attributes(array("class" => "table table-striped"));
        $grid->add('id', 'ID', true)->style("width:100px");
        $grid->add('order_date', 'Date');
        $grid->add('products.name', 'Product');
        $grid->add('size', 'Size');
        $grid->add('<img src="/images/products/{{ $img }}" height="25" width="25">', 'Image');
        $grid->add('color', 'Color');
        $grid->add('quantity', 'Qty');
        $grid->add('amount', 'Amount');
        $grid->edit('/backend/user-orders/edit', 'Curent Order', 'show');
        $grid->orderBy('id', 'asc');
        $grid->paginate(10);
        return $grid;
    }

    /**
     * Crud for user order.
     * @return mixed
     */
    public function UsersOrdersEdit()
    {
        $edit = DataEdit::source(new Order());
        $edit->label('View Order');
        $edit->add('users.name', 'Username', 'text');
        $edit->add('products.name', 'Product', 'text');
        $edit->add('size', 'Size', 'text');
        $edit->add('color', 'Color', 'text');
        $edit->link('/backend/user-orders', "Back", "TR");
        return $edit;
    }
}