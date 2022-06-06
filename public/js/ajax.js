// $(document).ready(function () {
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     var table = $('.data-table').DataTable({
//         serverSide: true,
//         processing: true,
//         ajax: "/blog",
//         columns: [
//             // for show id
//             // {
//             //     data: 'DT_RowIndex',
//             //     name: 'DT_RowIndex'
//             // },

//             {
//                 data: 'title',
//                 name: 'title'
//             },
//             {
//                 data: 'type',
//                 name: 'type'
//             },
//             {
//                 data: 'description',
//                 name: 'description'
//             },
//             {
//                 data: 'picture',
//                 name: 'picture'
//             },
//             {
//                 data: 'action',
//                 name: 'action'
//             },
//         ]
//     });

//     // open create employee form
//     $("#createBlog").click(function () {
//         $('#blog_id').val('');
//         $('#blogForm').trigger('reset');
//         $('#modalHeading').html('Add Blog');
//         $('#ajaxModel').modal('show');
//     });

//     // when click to add button
//     $("#addBlog").click(function (e) {
//         e.preventDefault();
//         $(this).html('Submit');
//         // $dd = $('#employeeForm').serialize()
//         // console.log($dd);
//         $.ajax({
//             data: $('#blogForm').serialize(),
//             url: blog_save,
//             method: 'POST',
//             dataType: 'json',
//             success: function (data) {
//                 $('#blogForm').trigger('reset');
//                 $('#ajaxModel').modal('hide');
//                 table.draw();

//             },
//             error: function (data) {
//                 console.log('Error: ', data);
//                 $("#addBlog").html('Submit');
//             }
//         });
//     });

//     $('body').on('click', '.deleteBlog', function () {
//         var emp_id = $(this).data('id');
//         confirm("Are you sure want to delete!");

//         $.ajax({
//             type: 'DELETE',
//             url: blog_save + '/' + blog_id,
//             success: function (data) {
//                 table.draw();
//             },
//             error: function (data) {
//                 console.log('Error: ', data);
//             }
//         });
//     });

//     $('body').on('click', '.editBlog', function () {
//         var blog_id = $(this).data('id');
//         $.get(blog_index + '/' + blog_id + '/edit', function (data) {
//             $('#modalHeading').html('Edit Record');
//             $('#ajaxModel').modal('show');
//             $('#blog_id').val(data.id);
//             $('#title').val(data.title);
//             $('#type').val(data.type);
//             $('#description').val(data.description);
//             $('#picture').val(data.picture);
//         });
//     });
// });













// // $(document).ready(function () {
// //     $.ajaxSetup({
// //         headers: {
// //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// //         }
// //     });
// //     var table = $('.data-table').DataTable({
// //         serverSide: true,
// //         processing: true,
// //         ajax: "/blog",
// //         columns: [
// //             // for show id
// //             // {
// //             //     data: 'DT_RowIndex',
// //             //     name: 'DT_RowIndex'
// //             // },
// //             {
// //                 data: 'title',
// //                 name: 'title'
// //             },
// //             {
// //                 data: 'type',
// //                 name: 'type'
// //             },
// //             {
// //                 data: 'description',
// //                 name: 'description'
// //             },
// //             {
// //                 data: 'picture',
// //                 name: 'picture'
// //             },
// //             {
// //                 data: 'action',
// //                 name: 'action'
// //             },
// //         ]
// //     });

// //     // open create employee form
// //     $("#createBlog").click(function () {
// //         $('#blog_id').val('');
// //         $('#blogForm').trigger('reset');
// //         $('#modalHeading').html('Add New Blog');
// //         $('#ajaxModel').modal('show');
// //     });

// //     // when click to add button
// //     $("#addBlog").click(function (e) {
// //         // alert("click addblog");
// //         e.preventDefault();

// //         $.ajax({
// //             data: $('#blogForm').serialize(),
// //             url: blog_save,
// //             method: 'POST',
// //             dataType: 'json',
// //             success: function (data) {
// //                 $('#blogForm').trigger('reset');
// //                 $('#ajaxModel').modal('hide');
// //                 table.draw();
// //             },
// //             error: function (data) {
// //                 console.log('Error: ', data);
// //                 $("#addBlog").html('Submit');
// //             }
// //         });
// //     });

// //     $('body').on('click', '.deleteBlog', function () {
// //         var emp_id = $(this).data('id');
// //         confirm("Are you sure want to delete!");

// //         $.ajax({
// //             type: 'DELETE',
// //             url: blog_save + '/' + blog_id,
// //             success: function (data) {
// //                 table.draw();
// //             },
// //             error: function (data) {
// //                 console.log('Error: ', data);
// //             }
// //         });
// //     });

// //     $('body').on('click', '.editBlog', function () {
// //         var blog_id = $(this).data('id');
// //         $.get(blog_index + '/' + blog_id + '/edit', function (data) {
// //             $('#modalHeading').html('Edit Record');
// //             $('#ajaxModel').modal('show');
// //             $('#blog_id').val(data.id);
// //             $('#title').val(data.title);
// //             $('#type').val(data.type);
// //             $('#description').val(data.description);

// //         });
// //     });
// // });
