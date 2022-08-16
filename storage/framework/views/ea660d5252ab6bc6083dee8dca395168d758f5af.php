<?php $__env->startSection('footer-script'); ?>
  <script src="https://www.paypal.com/sdk/js?client-id=<?php echo e(env('PAYPAL_CLIENT_ID')); ?>"></script>

  <script>
      $(document).ready(function () {
          paypal.Buttons({
              createOrder: async function (data, actions) {
                  return actions.order.create({
                      purchase_units: [{
                          amount: {
                              value: await axios.get("<?php echo e(route('cart.get-price')); ?>").then(r => {
                                  return r.data
                              })
                          }
                      }],
                      application_context: {
                          shipping_preference: 'NO_SHIPPING',
                      },
                  });
              },
              onApprove: function (data, actions) {
                  return actions.order.capture().then(function (details) {
                      console.log('Transaction completed by ' + details.payer.name.given_name)
                      $('.tab-content .tab-pane.show.active form').submit()
                  });
              }
          }).render('.paypal-button-container');
      })
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <!-- Breadcrumb -->
  <div class="breadcrumb-bar">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-12 col-12">
          <nav aria-label="breadcrumb" class="page-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('header.home')); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('patient_nav.cart')); ?></li>
            </ol>
          </nav>
          <h2 class="breadcrumb-title"><?php echo e(__('patient_nav.cart')); ?></h2>
        </div>
      </div>
    </div>
  </div>
  <!-- /Breadcrumb -->

  <!-- Page Content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">

        <!-- Profile Sidebar -->
        <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
          <div class="profile-sidebar">
            <?php echo $__env->make('patient.regular.profile-info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('patient.regular.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>
        <!-- / Profile Sidebar -->
        <div class="col-md-7 col-lg-8 col-xl-9">
          <div class="card">
            <div class="card-body">
            <?php
            $profile = auth()->user()->patientProfile()->first();
            $address = [];
            $set = false;
            if (isset($profile->country) or isset($profile->state) or isset($profile->city) or isset($profile->zip_code) or isset($profile->address)) {
              $set = true;
            }
            if ($profile) {
              $address['country'] = $profile->country ?? null;
              $address['state'] = $profile->state ?? null;
              $address['city'] = $profile->city ?? null;
              $address['zip_code'] = $profile->zip_code ?? null;
              $address['address'] = $profile->address ?? null;
            }
            ?>

            <!-- Tab Menu -->
              <nav class="user-tabs mb-4">
                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                  <?php if($set): ?>
                    <li class="nav-item">
                      <a class="nav-link <?php echo e(($set)?'active':null); ?>" href="#address_my"
                         data-toggle="tab"><?php echo e(__('cart.address_my')); ?></a>
                    </li>
                  <?php endif; ?>
                  <li class="nav-item">
                    <a class="nav-link <?php echo e((!$set)?'show active':null); ?>" href="#address_new"
                       data-toggle="tab"><?php echo e(__('cart.address_new')); ?></a>
                  </li>
                </ul>
              </nav>
              <!-- /Tab Menu -->

              <!-- Tab Content -->
              <div class="tab-content pt-0">
                <?php if($set): ?>
                  <div role="tabpanel" id="address_my" class="tab-pane fade <?php echo e(($set)?'show active':null); ?>">
                    <div class="row">
                      <div class="col-12">
                        <form action="<?php echo e(route('cart.proceed')); ?>" class="d-flex flex-wrap order-details-form" method="Post">
                          <?php echo csrf_field(); ?>
                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label><?php echo e(__('forms.country')); ?></label>
                              <input class="form-control" type="text" name="country" value="<?php echo e($address['country']??''); ?>">
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label><?php echo e(__('forms.state')); ?></label>
                              <input class="form-control" type="text" name="state" value="<?php echo e($address['state']??''); ?>">
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label><?php echo e(__('forms.city')); ?></label>
                              <input class="form-control" type="text" name="city" value="<?php echo e($address['city']??''); ?>">
                            </div>
                          </div>

                          <div class="col-12 col-md-6">
                            <div class="form-group">
                              <label><?php echo e(__('forms.postal-code')); ?></label>
                              <input class="form-control" type="text" name="zip_code" value="<?php echo e($address['zip_code']??''); ?>">
                            </div>
                          </div>

                          <div class="col-12">
                            <div class="form-group">
                              <label><?php echo e(__('forms.address')); ?></label>
                              <input class="form-control" type="text" name="address" value="<?php echo e($address['address']??''); ?>">
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>

                <div role="tabpanel" id="address_new" class="tab-pane fade <?php echo e((!$set)?'show active':null); ?>">
                  <div class="row">
                    <div class="col-12">
                      <form action="<?php echo e(route('cart.proceed')); ?>" class="d-flex flex-wrap order-details-form" method="Post">
                        <?php echo csrf_field(); ?>
                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label><?php echo e(__('forms.country')); ?></label>
                            <input class="form-control" type="text" name="country">
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label><?php echo e(__('forms.state')); ?></label>
                            <input class="form-control" type="text" name="state">
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label><?php echo e(__('forms.city')); ?></label>
                            <input class="form-control" type="text" name="city">
                          </div>
                        </div>

                        <div class="col-12 col-md-6">
                          <div class="form-group">
                            <label><?php echo e(__('forms.postal-code')); ?></label>
                            <input class="form-control" type="text" name="zip_code">
                          </div>
                        </div>

                        <div class="col-12">
                          <div class="form-group">
                            <label><?php echo e(__('forms.address')); ?></label>
                            <input class="form-control" type="text" name="address">
                          </div>
                        </div>

                      </form>
                    </div>
                  </div>
                </div>

                <div class="d-flex justify-content-end col-12">
                  <div class="paypal-button-container"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /Page Content -->
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.mainlayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/a/alexstrilby/ayrveda/resources/views/patient/cart-details.blade.php ENDPATH**/ ?>