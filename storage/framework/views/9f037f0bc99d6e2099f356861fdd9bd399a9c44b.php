<?php $__env->startSection('title', 'Class Management'); ?>

<?php $__env->startSection('content'); ?>
<section class="mt-2">
	<div class="container">
	    <ol class="breadcrumb font-weight-bolder">
	        <li class="breadcrumb-item">
	        	<img src="<?php echo e(asset('uploads/images/pages/logo.png')); ?>" alt="" width="15"> 
	        	Management Education
	        </li>
	        <li class="breadcrumb-item active">Class Management</li>
	    </ol>
	    <div class="row">
			<table class="table table-bordered">
			    <thead>
			        <tr>
			            <th>No.</th>
			            <th>Class Code</th>
			            <th>Module</th>
			            <th>Module Code</th>
			            <th class="text-center"><span><i class="fa fa-cog"></i></span></th>
			        </tr>
			    </thead>
			    <tbody>
			    	<?php $__currentLoopData = $teacher_class; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			        <tr>
			            <td><?php echo e($key + 1); ?></td>
			            <td><?php echo e($value->class_code); ?></td>
			            <td><?php echo e($value->Module->name); ?></td>
			           	<td><?php echo e($value->Module->module_code); ?></td>
			           	<td class="text-center">
			           		<button type="button" class="badge badge-success view-student-class-btn" data-toggle="modal" data-target="#view-student-class-modal" data-code="<?php echo e($value->class_code); ?>" data-id="<?php echo e($value->id); ?>" ><span><i class="fa fa-eye"></i></span></button>
			           	</td>
			        </tr>
			       	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			    </tbody>
			</table>
		</div>
	</div>
</section>

<!-- The Modal View-Student-Class-Modal -->
<div class="modal" id="view-student-class-modal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">View All Students Class - <span id="class_code"></span></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
	            <table class="table table-bordered">
				    <thead>
				        <tr>
				            <th>No.</th>
				            <th>Name</th>
				            <th>Student Code</th>
				        </tr>
				    </thead>
				    <tbody id="view-student-class-table">
				  
				    </tbody>
				</table>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$(document).on('click', '.view-student-class-btn', function(){
			class_id = $(this).data('id');
			class_code = $(this).data('code');
			$('#class_code').html(class_code);
			console.log(class_id);
			$.ajax({
				url : 'teacher/view-student-class',
				type : 'GET',
				dataType : 'JSON',
				data : {
					class_id : class_id
				},
				success : function(result){
					var html = '';
					$.each(result, function(key, value){
						html += '<tr>';
							html += '<td>' + (key+1) + '</td>';
							html += '<td>' + value.name + '</td>';
							html += '<td>' + value.student_code + '</td>';
						html += '</tr>';
					});
					$('#view-student-class-table').html(html);
					console.log(result);
				}
			});
		});
	});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('teacher.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>