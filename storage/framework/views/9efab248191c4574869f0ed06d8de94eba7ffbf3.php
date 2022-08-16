<?php $__env->startSection('content'); ?>
  <!-- Page Wrapper -->
  <div class="page-wrapper">
    <div class="content container-fluid">

      <!-- Page Header -->
      <div class="page-header">
        <div class="row">
          <div class="col">
            <h3 class="page-title">Profile</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="<?php echo e(route('admin.doctors-list')); ?>">Doctors</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Page Header -->

      <?php
      $name = \App\User::userNameFormat($user);$name = \App\User::userNameFormat($user);

      if (($profile->country ?? null) !== null and ($profile->city ?? null) !== null) {
        $location = $profile->city . ', ' . $profile->country;
      } else {
        $location = 'Not set';
      }

      ?>

      <div class="row">
        <div class="col-md-12">
          <div class="profile-header">
            <div class="row align-items-center">
              <div class="col-auto profile-image">
                <a href="#">
                  <img class="rounded-circle" alt="User Image"
                       src="<?php echo e(($profile->photo??false)?Storage::url($profile->photo):'/assets_admin/img/profiles/avatar-01.jpg'); ?>">
                </a>
              </div>
              <div class="col ml-md-n2 profile-user-info">
                <h4 class="user-name mb-0"><?php echo e($name); ?></h4>
                <h6 class="text-muted"><?php echo e($user->email); ?></h6>
                <form action="<?php echo e(route('admin.seller-set')); ?>" method="Post">
                  <?php echo csrf_field(); ?>
                  <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                  <label>
                    <input type="checkbox" name="seller" id="check-input-seller" <?php if($user->hasRole('Seller')): ?><?php echo e('checked'); ?><?php endif; ?>>
                    Manager for Sales
                  </label>
                </form>
                <script>
                    document.getElementById('check-input-seller').onchange = (event) => {
                        event.target.closest('form').submit()
                    }
                </script>
                <div class="user-Location"><i class="fa fa-map-marker"></i> <?php echo e($location); ?></div>
                <div class="about-text"><?php echo e($profile->biography??null); ?></div>
              </div>
            </div>
          </div>
          <div class="profile-menu">
            <ul class="nav nav-tabs nav-tabs-solid">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#per_patients">Patients</a>
              </li>
            </ul>
          </div>
          <div class="tab-content profile-tab-cont">

            <!-- Personal Details Tab -->
            <div class="tab-pane fade show active" id="per_details_tab">

              <!-- Personal Details -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title d-flex justify-content-between">
                        <span>Personal Details</span>
                        <!--
                        <a class="edit-link" data-toggle="modal"
                           href="#edit_personal_details"><i class="fa fa-edit mr-1"></i>Edit</a>
                           -->
                      </h5>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                        <p class="col-sm-10"><?php echo e($name); ?></p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Date of
                          Birth</p>
                        <p class="col-sm-10"><?php echo e($profile->birth??null); ?></p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                        <p class="col-sm-10"><?php echo e($user->email); ?></p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                        <p class="col-sm-10"><?php echo e($profile->phone??null); ?></p>
                      </div>
                      <div class="row">
                        <p class="col-sm-2 text-muted text-sm-right mb-0">Address</p>
                        <p class="col-sm-10 mb-0">
                          <?php echo e($profile->zip_code??null); ?>, <?php echo e($profile->address??null); ?>

                        </p>
                      </div>
                    </div>
                  </div>

                  <!-- Edit Details Modal -->
                  <div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Personal Details</h5>
                          <button type="button" class="close" data-dismiss="modal"
                                  aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form>
                            <div class="row form-row">
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>First Name</label>
                                  <input type="text" class="form-control"
                                         value="John">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Last Name</label>
                                  <input type="text" class="form-control" value="Doe">
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label>Date of Birth</label>
                                  <div class="cal-icon">
                                    <input type="text" class="form-control"
                                           value="24-07-1983">
                                  </div>
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Email ID</label>
                                  <input type="email" class="form-control"
                                         value="johndoe@example.com">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Mobile</label>
                                  <input type="text" value="+1 202-555-0125"
                                         class="form-control">
                                </div>
                              </div>
                              <div class="col-12">
                                <h5 class="form-title"><span>Address</span></h5>
                              </div>
                              <div class="col-12">
                                <div class="form-group">
                                  <label>Address</label>
                                  <input type="text" class="form-control"
                                         value="4663 Agriculture Lane">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>City</label>
                                  <input type="text" class="form-control"
                                         value="Miami">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>State</label>
                                  <input type="text" class="form-control"
                                         value="Florida">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Zip Code</label>
                                  <input type="text" class="form-control"
                                         value="22434">
                                </div>
                              </div>
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Country</label>
                                  <input type="text" class="form-control"
                                         value="United States">
                                </div>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Save
                              Changes
                            </button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /Edit Details Modal -->

                </div>


              </div>
              <!-- /Personal Details -->

            </div>
            <!-- /Personal Details Tab -->

            <!-- Patients Tab -->
            <div class="tab-pane fade" id="per_patients">

              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <form action="<?php echo e(route('admin.doctor-add-patient')); ?>" method="Post"
                            id="add-patient-to-doc">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($user->id); ?>">
                        <div class="input-group col-4">
                          <input type="text" class="form-control" name="patient_id"
                                 placeholder="Patient ID (P2, P12, etc.)" required>
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Add Patient
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Patients Details -->
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="datatable table table-hover table-center mb-0">
                          <thead>
                          <tr>
                            <th>Patient ID</th>
                            <th>Patient Name</th>
                            <th>Member Since</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php $__currentLoopData = $patients??[]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $patient = App\User::find($patient->user_id);
                            $name = 'deleted';
                            unset($profile);
                            if (($patient ?? null) !== null) {
                              $profile = $patient->patientProfile()->first();
                              $name = \App\User::userNameFormat($patient);
                            }
                            ?>
                            <tr>
                              <td>P<?php echo e($patient->id??null); ?></td>
                              <td>
                                <h2 class="table-avatar">
                                  <a href="<?php echo e(route('admin.patient-profile', ['id' => $patient->id??0])); ?>"
                                     class="avatar avatar-sm mr-2"><img
                                      class="avatar-img rounded-circle"
                                      src="<?php echo e(($profile->photo??false)?Storage::url($profile->photo):'/assets_admin/img/doctors/doctor-thumb-01.jpg'); ?>"
                                      alt="User Image"></a>
                                  <a href="<?php echo e(route('admin.patient-profile', ['id' => $patient->id??0])); ?>"><?php echo e($name); ?></a>
                                </h2>
                              </td>
                              <?php
                              $date = date('j M Y', strtotime($patient->created_at ?? null));
                              $time = date('g:i a', strtotime($patient->created_at ?? null));
                              ?>

                              <td><?php echo e($date??null); ?> <br><small><?php echo e($time??null); ?></small></td>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>


                </div>
                <!-- /Patients Details -->

              </div>
              <!-- /Patients Tab -->

            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /Page Wrapper -->

  </div>
  <!-- /Main Wrapper -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout_admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/admin/doctor/show-profile.blade.php ENDPATH**/ ?>