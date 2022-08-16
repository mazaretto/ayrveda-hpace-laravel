<?php $__env->startSection('footer-script'); ?>
  <script src="<?php echo e(asset('js/chat.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('head-data'); ?>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Page Content -->
  <div class="content" id="app" style="padding:0;">
    <div class="container-fluid" style="padding:0;">
      <div class="row">
        <div class="col-xl-12">
          <div class="chat-window">

            <!-- Chat Left -->
            <div class="chat-cont-left">
              <div class="chat-header">
                <?php if($user->hasRole('Doctor')): ?>
                  <a href="<?php echo e(route('doctor.dashboard')); ?>"><?php echo e(__('chat.back')); ?></a>
                <?php elseif($user->hasRole('Patient')): ?>
                  <a href="<?php echo e(route('patient.dashboard')); ?>"><?php echo e(__('chat.back')); ?></a>
                <?php endif; ?>
                
                <div class="chat-add">
                  <form action="<?php echo e(route('chat.add')); ?>">
                    <div class="form-group">
                      <label>
                        Введите ID пользователя<br>
                        <small class="text-danger"></small>
                        <small class="text-primary"></small>
                        <input type="text" class="form-control">
                      </label>
                    </div>
                    <button class="btn btn-primary" type="submit">Добавить</button>
                  </form>
                </div>
              </div>








              <div class="chat-users-list">
                <div class="chat-scroll">
                  <chat-list :chat-lists="<?php echo e($chats); ?>"></chat-list>
                </div>
              </div>
            </div>
            <!-- /Chat Left -->


            <!-- Chat Right -->
            <div class="chat-cont-right">
              <chat-messages ref="chatMessages" v-if="chatInfo" :messages="messages" :chat-info="chatInfo" :user-info="userInfo"></chat-messages>
              <chat-form ref="chatForm" v-if="chatInfo" @message-sent="addMessage" csrf="<?php echo e(csrf_token()); ?>" form-upload="<?php echo e(route('chat.upload-single')); ?>" :chat-info="chatInfo" :user-info="userInfo"></chat-form>
            </div>
            <!-- /Chat Right -->
          </div>

        </div>
      </div>
    </div>
    <!-- /Row -->
  </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/chat.blade.php ENDPATH**/ ?>