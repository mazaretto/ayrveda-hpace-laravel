<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item"><a
                  href="<?php echo e(route('doctors-list')); ?>"><?php echo e(__('header.doctors-list')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('header.doctors-profile')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('header.doctors-profile')); ?></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container">
    <?php
    $profile = $user->doctorProfile()->first();

    $name = \App\User::userNameFormat($user);

    ?>

    <!-- Doctor Widget -->
      <div class="card">
        <div class="card-body">
          <div class="doctor-widget">
            <div class="doc-info-left">
              <div class="doctor-img">
                <img
                  src="<?php echo e(($profile->photo??false)?Storage::url($profile->photo):'/assets/img/doctors/doctor-thumb-02.jpg'); ?>"
                  class="img-fluid" alt="User Image">
              </div>
              <div class="doc-info-cont">
                <h4 class="doc-name"><?php echo e($name); ?></h4>
                <p class="doc-speciality"><?php echo e($profile->clinic_name??null); ?></p>
                <p class="doc-department">
                  <?php $__currentLoopData = explode(',',$profile->specialist??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $str): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($loop->last): ?>
                      <?php echo e($str); ?>

                    <?php else: ?>
                      <?php echo e($str.', '); ?>

                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <div class="clinic-details">
                  <?php if($profile->clinic_address??false): ?>
                    <p class="doc-location"><i
                        class="fas fa-map-marker-alt"></i> <?php echo e($profile->clinic_address??null); ?>

                    </p>
                  <?php endif; ?>
                  <ul class="clinic-gallery">
                    <?php if($profile->clinic_pics??null): ?>
                      <?php $__currentLoopData = explode(',', $profile->clinic_pics); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                          <a href="<?php echo e(Storage::url($pic)); ?>"
                             data-fancybox="gallery">
                            <img src="<?php echo e(Storage::url($pic)); ?>" alt="Feature">
                          </a>
                        </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </ul>
                </div>
                <div class="clinic-services">
                  <?php if($profile->services??false): ?>
                    <?php $__currentLoopData = explode(',', $profile->services??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <span><?php echo e($serv); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </div>

                
              </div>
            </div>
            <div class="doc-info-right">
              <div class="clini-infos">
                <ul>
                  <li><i class="fas fa-map-marker-alt"></i> <?php echo e($profile->clinic_address??null); ?></li>
                  <li><i class="fa fa-phone"></i> <?php echo e($user->phone??null); ?></li>
                  <li><i class="fa fa-birthday-cake"></i> <?php echo e($profile->birth??null); ?></li>

                  
                </ul>
              </div>

              
            </div>
          </div>
        </div>
      </div>
      <!-- /Doctor Widget -->

      <!-- Doctor Details Tab -->
      <div class="card">
        <div class="card-body pt-0">

          <!-- Tab Menu -->
          <nav class="user-tabs mb-4">
            <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
              <li class="nav-item">
                <a class="nav-link active" href="#doc_overview"
                   data-toggle="tab"><?php echo e(__('regular.overview')); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#doc_education"
                   data-toggle="tab"><?php echo e(__('regular.education-awards')); ?></a>
              </li>
            </ul>
          </nav>
          <!-- /Tab Menu -->

          <!-- Tab Content -->
          <div class="tab-content pt-0">

            <!-- Overview Content -->
            <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
              <div class="row">
                <div class="col-md-12 col-lg-9">

                  <!-- About Details -->
                  <div class="widget about-widget">
                    <h4 class="widget-title"><?php echo e(__('forms.about_me')); ?></h4>
                    <p><?php echo e($profile->biography??null); ?></p>
                  </div>
                  <!-- /About Details -->

                  <!-- Social List -->
                  <div class="service-list">
                    <h4><?php echo e(__('regular.socials')); ?></h4>
                    <?php
                    $soc = $user->social()->first();
                    ?>
                    <ul class="clearfix social">
                      <?php if($soc->facebook??false): ?>
                        <li><a href="<?php echo e($soc->facebook); ?>" target="_blank"><i
                              class="fab fa-facebook"></i></a></li>
                      <?php endif; ?>
                      <?php if($soc->twitter??false): ?>
                        <li><a href="<?php echo e($soc->twitter); ?>" target="_blank"><i
                              class="fab fa-twitter"></i></a></li>
                      <?php endif; ?>
                      <?php if($soc->instagram??false): ?>
                        <li><a href="<?php echo e($soc->instagram); ?>" target="_blank"><i
                              class="fab fa-instagram"></i></a></li>
                      <?php endif; ?>
                      <?php if($soc->pinterest??false): ?>
                        <li><a href="<?php echo e($soc->pinterest); ?>" target="_blank"><i
                              class="fab fa-pinterest"></i></a></li>
                      <?php endif; ?>
                      <?php if($soc->linkedin??false): ?>
                        <li><a href="<?php echo e($soc->linkedin); ?>" target="_blank"><i
                              class="fab fa-linkedin"></i></a></li>
                      <?php endif; ?>
                      <?php if($soc->youtube??false): ?>
                        <li><a href="<?php echo e($soc->youtube); ?>" target="_blank"><i
                              class="fab fa-youtube"></i></a></li>
                      <?php endif; ?>
                    </ul>
                  </div>
                  <!-- /Social List -->

                  <!-- Experience Details -->
                  <div class="widget experience-widget">
                    <h4 class="widget-title"><?php echo e(__('regular.work-experience')); ?></h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $exp = unserialize($profile->experience ?? null);
                        ?>
                        <?php if($exp): ?>
                          <?php for($i=count($exp)-1;$i>=0;$i--): ?>
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <a href="javascript:void(0)"
                                     class="name"><?php echo e($exp[$i][0]); ?> (<?php echo e($exp[$i][3]); ?>

                                    )</a>
                                  <span
                                    class="time"><?php echo e($exp[$i][1]); ?> - <?php echo e($exp[$i][2]); ?></span>
                                </div>
                              </div>
                            </li>
                          <?php endfor; ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <!-- /Experience Details -->

                  <!-- Services List -->
                  <div class="service-list">
                    <h4><?php echo e(__('forms.services')); ?></h4>
                    <ul class="clearfix">
                      <?php $__currentLoopData = explode(',', $profile->services??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($serv); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                  <!-- /Services List -->

                  <!-- Specializations List -->
                  <div class="service-list">
                    <h4><?php echo e(__('forms.specialization')); ?></h4>
                    <ul class="clearfix">
                      <?php $__currentLoopData = explode(',', $profile->specialist??null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($spec); ?></li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                  </div>
                  <!-- /Specializations List -->

                </div>
              </div>
            </div>
            <!-- /Overview Content -->

            <!-- Education Content -->
            <div role="tabpanel" id="doc_education" class="tab-pane fade">
              <div class="row">
                <div class="col-md-12 col-lg-9">
                  <!-- Education Details -->
                  <div class="widget education-widget">
                    <h4 class="widget-title"><?php echo e(__('forms.education')); ?></h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $educ = unserialize($profile->education ?? null);
                        ?>
                        <?php if($educ): ?>
                          <?php $__currentLoopData = $educ; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <a href="javascript:void(0)"
                                     class="name"><?php echo e($row[0]); ?> - <?php echo e($row[1]); ?>

                                    <span class="time"><?php echo e($row[2]); ?></span>
                                </div>
                              </div>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <!-- /Education Details -->

                  <!-- Awards Details -->
                  <div class="widget awards-widget">
                    <h4 class="widget-title"><?php echo e(__('forms.awards')); ?></h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $awar = unserialize($profile->awards ?? null);
                        ?>
                        <?php if($awar): ?>
                          <?php $__currentLoopData = $awar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <p class="exp-year"><?php echo e($row[1]); ?></p>
                                  <h4 class="exp-title"><?php echo e($row[0]); ?></h4>
                                </div>
                              </div>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <!-- /Awards Details -->

                  <!-- Memberships Details -->
                  <div class="widget awards-widget">
                    <h4 class="widget-title"><?php echo e(__('forms.memberships')); ?></h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $mem = unserialize($profile->membership ?? null);
                        ?>
                        <?php if($mem): ?>
                          <?php $__currentLoopData = $mem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <h4 class="exp-title"><?php echo e($row[0]); ?></h4>
                                </div>
                              </div>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <!-- /Memberships Details -->

                  <!-- Registrations Details -->
                  <div class="widget awards-widget">
                    <h4 class="widget-title"><?php echo e(__('forms.registrations')); ?></h4>
                    <div class="experience-box">
                      <ul class="experience-list">
                        <?php
                        $reg = unserialize($profile->registrations ?? null);
                        ?>
                        <?php if($reg): ?>
                          <?php $__currentLoopData = $reg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                              <div class="experience-user">
                                <div class="before-circle"></div>
                              </div>
                              <div class="experience-content">
                                <div class="timeline-content">
                                  <p class="exp-year"><?php echo e($row[1]); ?></p>
                                  <h4 class="exp-title"><?php echo e($row[0]); ?></h4>
                                </div>
                              </div>
                            </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                  <!-- /Registrations Details -->
                </div>
              </div>
            </div>
            <!-- /Education Content -->
          </div>
        </div>
      </div>
      <!-- /Doctor Details Tab -->

    </div>
  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/doctor-profile.blade.php ENDPATH**/ ?>