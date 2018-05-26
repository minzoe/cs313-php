<header>
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li <?php if($current=="home" ) { ?> class="active"
                <?php   }  ?> >
                <a href='index.php'>Home</a>
            </li>
            <li <?php if($current=="user" ) { ?> class="active"
                <?php   }  ?> >
                <a href='admin.php'>Projects</a>
            </li>
    </nav>
</header>