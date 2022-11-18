<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Management</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('test/style.css')}}">
</head>
<body>
    <div class="container">
        <div class="main-form">
            <form>
            <h2>Add Task</h2>
                <table id="this-table" class="sortable-table">
                    <thead>
                        <tr>
                            <td>Task Title</td>
                            <td>Task Value</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input class="form-control item_title" id="item_title" placeholder="Task 01:" type="text" name="title[]" />
                            </td>
                            <td>
                                <input class="form-control item_value" id="item_value" placeholder="lorem ipsum dolor sit amet" type="text" name="value[]" />
                            </td>
                            <td><a class="deleteRow"></a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" style="text-align: left;">
                                <div class="button-add"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <button id="submitBtn" class="btn btn-primary submit">Submit</button>
            </form>

        </div>
        <div class="form-data">
            <h2>All Task</h2>
            <div class="search">
                <input placeholder="Search keyword..." class="form-control" type="text" id="searchBox">
            </div>
            <table class="table table-dark">
                <thead>
                  <tr>
{{--                    <th scope="col">#</th>--}}
                    <th scope="col">Task Title</th>
                    <th scope="col">Task Value</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="tbody_value">
                      @foreach($test as $item)
                      <tr>
                        <td>{{$item -> title}}</td>
                        <td>{{$item -> value}}</td>
                          <td><a href="javascript:void(0)" class="btn btn-info dltBtn" data-id="{{$item->id}}">Delete</a></td>
                     </tr>
                      @endforeach
                </tbody>
              </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="{{asset('test/scripts.js')}}"></script>

</body>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#submitBtn").on('click',function (e){
            e.preventDefault();

            var title = $("input[name='title[]']")
                .map(function(){return $(this).val();}).get();

            var value = $("input[name='value[]']")
                .map(function(){return $(this).val();}).get();
            $.ajax({
                url: "{{route('test.store')}}",
                method:'post',
                data: {
                    title: title,
                    value: value,
                },
                success:function (data){
                    if(data.success == true){
                        $('#tbody_value').html(data);
                        $('.item_title').val('');
                        $('.item_value').val('');
                    }else{
                        $('#tbody_value').html(data);
                        $('.item_title').val('');
                        $('.item_value').val('');
                    }
                },
                error:function(data){
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('#searchBox').on('keyup',function(){
            $value = $(this).val();
            $.ajax({
                type : 'get',
                url: "{{route('test.search')}}",
                data:{
                    'search':$value
                },
                success:function(data){
                    $('#tbody_value').html(data);
                }
            });
        });

        //delete Category
        $(".dltBtn").on('click',function (e){
            var value = $(this).data('id');
            // alert(value);
            $.ajax({
                type : 'get',
                url: "{{route('test.delete')}}",
                data: {
                    value: value,
                },
                success:function(data){
                    $('#tbody_value').html(data);
                }
            });

        });
    });
</script>
</html>
