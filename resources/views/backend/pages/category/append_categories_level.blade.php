
<div class="form-group appendCategoryLevel">
    <label>Select Category Label</label>
    <select class="select2" multiple="multiple" name="parent_id" id="parent_id" data-placeholder="Select labels" style="width: 100%;">
        <option value="0">Main Category</option>
        @if (!empty($categories))
            @foreach ($categories as $category)
            <option value="{{$category['id']}}">{{$category['category_name']}}</option>
                @if (!empty($category['sub_categories']))
                    @foreach ($category['sub_categories'] as $subcategory)
                    <option value="{{$subcategory['id']}}">&nbsp; &raquo; &nbsp;{{$subcategory['category_name']}}</option>
                    @endforeach
                @endif
            @endforeach
        @endif
    </select>
</div>
