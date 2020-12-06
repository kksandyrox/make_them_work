<div class="mt-5 footer-adjustment">
    <div class="row">
        <?php echo $this->element('sidebar/sticky-sidebar');?>
        <div class="col-lg-8">
            <?php $images = json_decode($pothole['image']); ?>
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
            <div class="jumbotron ">
                <h4 class="card-title font-bold pb-2"><strong><?php echo $pothole['location'];?></strong></h4>
                <div class="view overlay my-4">
                    <img src="<?php echo $images->image_0;?>" class="img-fluid" alt="">
                    <a href="#">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

            <div class="row">
                <div class="col-lg-6">
                    <h5>
                        <span href="#!" class="badge badge-default" title="Constituency">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?php echo $pothole['constituency']['name'];?>
                        </span>
                        <span class="badge <?php echo $severityClass;?>" title="Severity">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                            <?php echo $severityVerb;?>
                        </span>
                        <span class="badge badge-default" title="Total Verifications">
                            <i class="fa fa-flash"></i>
                            <?php echo count($pothole['pothole_verifications']);?>
                        </span>
                    </h5>
                </div>
                <div class="col-lg-6">
                    <!-- <?php pr($pothole);?> -->
                    <?php
                        $currentUserVerified = false; 
                        foreach($pothole['pothole_verifications'] as $pothole_verification) {
                            if($userId == $pothole_verification['user_id']) {
                                $currentUserVerified = true;
                            }
                        }
                    ;?>
                    <?php if(!$currentUserVerified): ?>
                        <p>
                        <a class="verify-now" id="" data-toggle="modal" data-target="#basicExampleModal" data-pothole-id="<?php echo $pothole['id'];?>" data-user-id="<?php echo $userId;?>">Verify Now: <i class="fa fa-flash fa-lg red-text" title="Verify Now"></i></a>
                        </p>
                    <?php endif;?>
                
                    <p>
                        Share on Facebook:
                        <?php 
                                echo $this->SocialShare->fa(
                                    'facebook',
                                     '/potholes/publicView/'. $pothole['id']
                                );
                            ?>
                    </p>

                </div>    
            </div>
                <p class="card-text">Description: <?php echo $pothole['description'];?></p>
            </div>
            <hr />
            <p>More Images</p>
            <?php foreach ($images as $key => $image):?>  
                <a href="<?php echo $image;?>" data-lightbox="roadtrip"><img src="<?php echo $image;?>" alt="thumbnail" class="img-thumbnail" style="width: 200px">
                </a>
            <?php endforeach;?>
        </div>
    </div>
</div>
