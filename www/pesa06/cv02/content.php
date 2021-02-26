
<body>
<div class="container" style="text-align: center">
    <?php foreach ($people as $person):?>
        <div class="card card-dark col-md-6 mb-5">
            <div class="card-header">Business card</div>
            <div class="card-body">
                <div style="text-align: center">
                    <img src="logo.png">
                </div>
                <div class="row">
                    <div class="col-md-6"><?php echo $person->getName(); ?></div>
                    <div class="col-md-6"><?php echo $person->getSurname(); ?></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12">
                        <small><?php echo $person->countAge(); ?> let</small>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6"><?php echo $person->getPosition(); ?></div>
                    <div class="col-md-6"><?php echo $person->getCompanyName(); ?></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6"><?php echo $person->getAddress()->buildStreetWithNumbers() ?></div>
                    <div class="col-md-6"><?php echo $person->getAddress()->getCity() . ', ' . $person->getAddress()->getPostcode() ?></div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-phone" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        <?php echo $person->getPhone(); ?>
                    </div>
                    <div class="col-md-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                        </svg>
                        <?php echo $person->getEmail() ?>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-globe" viewBox="0 0 16 16">
                            <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm7.5-6.923c-.67.204-1.335.82-1.887 1.855A7.97 7.97 0 0 0 5.145 4H7.5V1.077zM4.09 4a9.267 9.267 0 0 1 .64-1.539 6.7 6.7 0 0 1 .597-.933A7.025 7.025 0 0 0 2.255 4H4.09zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a6.958 6.958 0 0 0-.656 2.5h2.49zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5H4.847zM8.5 5v2.5h2.99a12.495 12.495 0 0 0-.337-2.5H8.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5H4.51zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5H8.5zM5.145 12c.138.386.295.744.468 1.068.552 1.035 1.218 1.65 1.887 1.855V12H5.145zm.182 2.472a6.696 6.696 0 0 1-.597-.933A9.268 9.268 0 0 1 4.09 12H2.255a7.024 7.024 0 0 0 3.072 2.472zM3.82 11a13.652 13.652 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5H3.82zm6.853 3.472A7.024 7.024 0 0 0 13.745 12H11.91a9.27 9.27 0 0 1-.64 1.539 6.688 6.688 0 0 1-.597.933zM8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855.173-.324.33-.682.468-1.068H8.5zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.65 13.65 0 0 1-.312 2.5zm2.802-3.5a6.959 6.959 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5h2.49zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7.024 7.024 0 0 0-3.072-2.472c.218.284.418.598.597.933zM10.855 4a7.966 7.966 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4h2.355z"/>
                        </svg>
                        <a href="https://www.<?php echo $person->getWebsite() ?>"><?php echo $person->getWebsite()?></a>
                    </div>
                    <div class="col-md-6">
                        Currently accepting contracts?
                        <?php if ($person->isOpenToPositions()) {
                            echo '<i class="badge badge-pill badge-success">YES</i>';
                        } else {
                            echo '<i class="badge badge-pill badge-danger">NO</i>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
</body>