@extends('admin::layout.main')

@section('title')
	FAQs
@endsection

@section('page_title')
	Frequently Asked Questions
@endsection

@section('breadcrumbs')
	@parent
	<li class="active"><span><i class="fa fa-list"></i> FAQs</span></li>
@endsection

@section('sidebar')
	@parent
	@include('faqs::admin.sidebar')
@endsection

@section('content')
    <table class="table table-striped" id="faqsDataTable">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>Question</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($faqs as $faq)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $faq->question }}</td>
                <td>
                    <div class="btn-group">
                        <a href="{{ route('admin-faqs-edit',$faq->id) }}" class="btn btn-sm btn-success btn-round"><i class="fa fa-edit"></i> Edit</a>
                        <a href="javascript:publishQuestion({{ $faq->id }})" class="btn btn-warning btn-sm btn-round"><span class="fa fa-arrow-{{ $faq->published ? 'down' : 'up' }}"></span>&nbsp;&nbsp; {{ $faq->published ? ' Unpublish' : 'Publish' }}</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts_bottom')
	<script type="text/javascript">
		var publishQuestion = function (pID){
			if(confirm("Do you want to publish the selected package?")){
				$.ajax({
					url: '{{ route('admin-faqs-publish') }}',
					type: 'post',
					data: { id: pID, _token: '{{ csrf_token() }}' },
					complete: function(xhr){
						$.notify(
                            {
                                message:xhr.responseJSON.message,
                                icon: 'check_circle'
                            },
                            {
                                type: xhr.responseJSON.type ? xhr.responseJSON.type : 'success'
                            }
                        );
					}
				})
			}else{
				alert("package not published/unpublished")
			}
		}

		$('#categoriesModal').on('show.bs.modal', function (e) {
			var button = $(e.relatedTarget) // Button that triggered the modal
		  	var id = button.data('id')
			$('form input[name="id"]').val(id)
			let data = button.data('categories');
			// console.log(data.length)
			if(data.length>1)
				categories = data.split(',');
			else
				categories = data
			console.log(categories)
			$('form select#categories').selectpicker('val', categories);

		})

        $(document).ready(function(){
            $('#packagesDataTable').dataTable();
        })

	</script>
@endsection

@section('content_classes')
    table-responsive
@endsection
