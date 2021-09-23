@includewhen(!count($data->posts),'alerts.empty',['msg'=>'لا توجد اي مشاركات بعد'])
<div class="row mb-2">
    @foreach($data->posts as $post)
    <div class="col-lg-3 col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><a href=""></a>{{$post->title}}</h5>
            </div>
        </div>
        <div class="dropdown">
            <a class="dropdown-toggle link" data-toggle="dropdown">
                <span>المزيد</span>
            </a>
            <div class="dropdown-menu">
                @can('edit-post',$post)
                <a class="dropdown-item" href="">تعديل</a>
                @endcan
                @can('delete-post',$post )
                <a class="dropdown-item" href="">حذف</a>
                @endcan
            </div>
        </div>
    </div>
    @endforeach
</div>