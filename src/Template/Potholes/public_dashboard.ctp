<div class="mt-5 footer-adjustment">
    <div class="row">
        <div class="col-lg-9 offset-lg-3">
            <hr class="my-2">
            <h3>Recent news...</h3>
            <div class="row">
                <div class="col-lg-6">
                    <?php 
                        echo $this->Form->control(
                            'constituency_id', [
                            'empty' => 'All',
                            'options' => $constituencies,
                            'type' => 'select',
                            'class' => 'form-control mb-4',
                            'label' => false,
                            'required',
                            'default' => $filter,
                            "id" => "public-constituency-filter"
                        ]);
                    ?>            
                </div>
            </div>
            <?php if(!empty($potholes)): ?>
                <div class="row">
                    <?php foreach($potholes as $pothole): ?>
                        <?php 
                            if($pothole['severity'] == 1) {
                                $severityClass = "green";
                                $severityVerb = "Low";
                            }
                            else if($pothole['severity'] == 2) {
                                $severityClass = "orange";
                                $severityVerb = "Moderate";
                            }
                            else {
                                $severityClass = "red";
                                $severityVerb = "High";
                            }
                        ;?>
                        <?php $primaryImage = json_decode($pothole['image'], TRUE)['image_0'];?>
                        <div class="col-sm-12 col-lg-9 mt-5">
                            <div class="card h-100">
                                <img class="card-img-top" src="http://mtw.sj/<?php echo $primaryImage;?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $pothole['location'];?></h5>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <p class="mb-0">Constituency: <a href="#!" class="badge badge-primary"><?php echo $pothole['constituency']['name'];?></a></p>
                                            <p>Severity: <span class="badge badge-pill <?php echo $severityClass;?>"><?php echo $severityVerb;?></span></p>
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="card-title">Total Verifications: 
                                                <span class="badge badge-default"><?php echo count($pothole['pothole_verifications']);?></span>
                                            </p>
                                            <?php
                                                $currentUserVerified = false; 
                                                foreach($pothole['pothole_verifications'] as $pothole_verification) {
                                                    if($userId == $pothole_verification['user_id']) {
                                                        $currentUserVerified = true;
                                                    }
                                                }
                                            ;?>
                                            <?php if($currentUserVerified): ?>
                                                <span>Verified!</span>
                                            <?php else:?>
                                                <a class="verify-now" id="" data-toggle="modal" data-target="#basicExampleModal" data-pothole-id="<?php echo $pothole['id'];?>" data-user-id="<?php echo $userId;?>">Verify Now: <i class="fa fa-flash fa-lg red-text"></i></a>
                                            <?php endif;?>

                                        </div>
                                    </div>
                                    <div class="row text-left">
                                        <div class="col-lg-6">
                                            <p class="card-text"><?php echo $pothole['description'];?></p>
                                            <a href="/potholes/publicView/<?php echo $pothole['id'];?>" class="btn btn-mdb-color">Read More</a>
                                        </div>
                                        <div class="col-lg-6">
                                            <?php 
                                                echo $this->SocialShare->fa(
                                                    'facebook',
                                                    'http://mtw.sj/potholes/publicView/23'
                                                );
                                            ?>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>             
                </div>
            <?php else: ?>
                <h4>No matching results</h4>
            <?php endif;?>
            <div id="goTop"></div>
            <?php
                $this->Paginator->setTemplates([
                    'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]);
                $this->Paginator->setTemplates([
                    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]);                   
                $this->Paginator->setTemplates([
                    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]);
                $this->Paginator->setTemplates([
                    'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]);
                $this->Paginator->setTemplates([
                    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]);
                $this->Paginator->setTemplates([
                    'current' => '<li class="page-item active"><a class="page-link" href="{{url}}">{{text}}</a></li>'
                ]);
            ?>
            <nav class="mt-5">
                <ul class="pagination pagination-lg">
                    <?= $this->Paginator->prev('< ' . __('previous')) ?>
                    <?= $this->Paginator->numbers() ?>
                    <?= $this->Paginator->next(__('next') . ' >') ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Please Login to continue</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Only Registered and logged in members can Verify a Pothole.
      </div>
      <div class="modal-footer">
        <div class="row">
            <div class="col-lg-6"><a href="/users/login">Login</a></div>
            <div class="col-lg-6"><a href="/users/register">Register</a></div>
        </div>
      </div>
    </div>  
  </div>
</div>


        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyAoB4srvQLED31oxlKzgLnKcbilJWws-38"></script>
        <script>
            function init() {
                var input = document.getElementById('location');
                var autocomplete = new google.maps.places.Autocomplete(input);
            }
 
            google.maps.event.addDomListener(window, 'load', init);
        </script>  
