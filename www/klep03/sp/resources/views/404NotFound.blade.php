@include('includes.element-head')



<form id="signInForm" class="signForm" action="<?= $pageItems['urlPrefix'] ?>/signin/submit" method="POST">
    <h1>404 – Not Found</h1>
    <p>Sorry, the page you are looking for is not available. </p>
    @if (isset($reason))
        <p>Reason: <?= $reason ?></p>    
    @endif

@include('includes.element-foot')
