Welcome to official site of mdcms (Markdown Content Management System). If you are new to mdcms, view our articles first.

*mdcms is still experimental and evolving.*

<!-- Separator. -->
<div style="padding-top: 25pt;"></div>

<pre class="install-on-windows" style="display: none;"><code class="shell">> choco install php --version=7.4.30
> choco install composer
> choco install nodejs --version=16.15.1
> choco install rsync
> choco install sed
</code></pre>

<pre class="run-on-windows" style="display: none;"><code class="shell">> git clone https://github.com/cwchentw/mdcms.git mysite
> cd mysite
> .\tools\bin\serve.bat
</code></pre>

<pre class="run-on-windows" style="display: none;"><code class="shell">> git remote set-url origin https://example.com/user/mysite.git
> .\tools\bin\migrate.bat
> git add .
> git commit -m "Migrate to a new site"
> git push -u origin master
</code></pre>

<pre class="install-on-macos" style="display: none;"><code class="shell">$ brew install php@7.4
$ brew install composer
$ brew install node@16
</code></pre>

<pre id="run-on-macos" style="display: none;"><code class="shell">$ git clone https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/serve
</code></pre>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ sudo apt install php php-xml php-mbstring php-zip unzip
</code></pre>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ curl -o composer-setup.php https://getcomposer.org/installer
$ php composer-setup.php --install-dir=$HOME/bin --filename=composer
</code></pre>

<p class="install-on-ubuntu" style="display: none;">Install <a href="https://github.com/nvm-sh/nvm"><code>nvm</code></a></p>

<pre class="install-on-ubuntu" style="display: none;"><code class="shell">$ nvm install 16.15.1
$ nvm use 16.15.1
</code></pre>

<pre id="run-on-ubuntu" style="display: none;"><code class="shell">$ git clone https://github.com/cwchentw/mdcms.git mysite
$ cd mysite
$ ./tools/bin/serve
</code></pre>

<pre id="run-on-unix" style="display: none;"><code class="shell">$ git remote set-url origin https://example.com/user/mysite.git
$ ./tools/bin/migrate
$ git add .
$ git commit -m "Migrate to a new site"
$ git push -u origin master
</code></pre>

<script>
(function () {
    function isWindows () {
        return window.navigator.userAgent.indexOf("Windows") !== -1;
    }

    function isMacOS () {
        return window.navigator.userAgent.indexOf("Mac") !== -1;
    }

    if (isWindows()) {
        var installOnWindows = document.getElementsByClassName("install-on-windows");
        for (var i = 0; i < installOnWindows.length; ++i) {
            installOnWindows[i].style.display = "inherit";
        }

        var runOnWindows = document.getElementsByClassName("run-on-windows");
        for (var i = 0; i < runOnWindows.length; ++i) {
            runOnWindows[i].style.display = "inherit";
        }
    }
    else if (isMacOS()) {
        var installOnMacOS = document.getElementsByClassName("install-on-macos");
        for (var i = 0; i < installOnMacOS.length; ++i) {
            installOnMacOS[i].style.display = "inherit";
        }

        document.getElementById("run-on-macos").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";
    }
    else {
        var installOnUbuntu = document.getElementsByClassName("install-on-ubuntu");
        for (var i = 0; i < installOnUbuntu.length; ++i) {
            installOnUbuntu[i].style.display = "inherit";
        }

        document.getElementById("run-on-ubuntu").style.display = "inherit";
        document.getElementById("run-on-unix").style.display = "inherit";
    }
})();
</script>
