 <style>
    .close {
        border: 1px rgb(183, 183, 183);
        border-radius: 100% ;
        color: rgb(65, 65, 65);
        background: rgb(172, 172, 172);
        float: right;
        font-size: 15px;
    }
 </style>
 <?php //Hiển thị thông báo thành công
 ?>
 @if (Session::has('success'))
     <div class="alert alert-success alert-dismissible" role="alert">
         <strong>{{ Session::get('success') }}</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             <span class="sr-only"></span>
         </button>
     </div>
 @endif
 <?php //Hiển thị thông báo lỗi
 ?>
 @if (Session::has('error'))
     <div class="alert alert-danger alert-dismissible" role="alert">
         <strong>{{ Session::get('error') }}</strong>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             <span class="sr-only"></span>
         </button>
     </div>
 @endif
 @if ($errors->any())
     <div class="alert alert-danger alert-dismissible" role="alert">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             <span class="sr-only"></span>
         </button>
     </div>
 @endif
 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 <script>
     $(document).ready(function() {
         $('.alert .close').on('click', function() {
             //trả về lớp cha với hiệu ứng mờ
             $(this).parent().fadeOut();
         });
     });
 </script>

