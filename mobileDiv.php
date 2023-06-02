<?php
  $page = __FILE__;
include "./header.php";
include "./navbar.php";
?>
<div id="main">
    <div id="header" class="section mb-5">
        <img src="greg.ico" class="lax"
            data-lax-translate-x="0 0, vh -500" data-lax-optimize=true />
        <img src="greg.ico" class="lax my-5" data-lax-translate-x="0 0, vh 500"
            data-lax-optimize=true />
        <img src="greg.ico" class="lax mt-2"
            data-lax-opacity="0 1, (0.8*vh) 0" />
        <?php 
        $n =1;
        for ($i=0; $i < 6; $i++) { 
            $y = 250;
            $x = cos($i)*150;
            echo "<img src='greg.ico' class='lax' style='margin-top: -79pt'
            data-lax-translate-y='0 0, vh $y ' data-lax-translate-x='0 0, vh $x '/>";
        }
        ?>
<br><br><br>

    </div>


    <div id="section1" class="section">
        <div class="left">
            <div class="lax bubble a" style="background: #EDD943" data-lax-preset="lazy-250"></div>

            <div class="lax bubble c" style="background: #ED2471; margin-left: 80pt" data-lax-preset="lazy-100"></div>

            <div class="lax bubble b" style="background: #35D5E5; margin-left: 160pt" data-lax-preset="lazy-300"></div>

            <h3 data-lax-preset="spin"  data-lax-optimize=true class="lax chunkyText" style="color: #35D5E5;">Greg nul!
            </h3>
        </div>

        <div class="right">
            <div class="lax bubble a" style="background: #EDD943; margin-left: 120pt" data-lax-preset="lazy-200"></div>

            <div class="lax bubble c" style="background: #EDD943; margin-left: -20pt" data-lax-preset="lazy-150"></div>

            <div class="lax bubble b" style="background: #EDD943; margin-left: 20pt; margin-top: 200pt"
                data-lax-preset="lazy-350"></div>
            <h3 data-lax-optimize=true data-lax-preset="swing" class="lax chunkyText"
                style="color: #EDD943; margin-top: 200pt;text-shadow:3px 0 10px #000">Pascalou!</h3>
        </div>

        <h3 data-lax-preset="zoomIn" class="lax crazyText" data-lax-optimize=true>ISSOU</h3>
    </div>

    <div id="section2" class="section">
        <div class="lax blockContainer" data-lax-preset="leftToRight-1.1 fadeInOut">
            <div class="lax block" style="background: #35D5E5;" data-lax-preset="spin"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.2 fadeInOut">
            <div class="lax block"
                style="background: #EDD943; margin-top: -50pt; margin-left: -50pt; width: 40pt; height: 40pt;"
                data-lax-preset="spinRev-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.4 fadeInOut">
            <div class="lax block" style="background: #ED2471; margin-top: -90pt; margin-left: -0pt;"
                data-lax-preset="spin-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.5 fadeInOut">
            <div class="lax block"
                style="background: #EDD943; margin-top: 70pt; margin-left: -150pt; width: 40pt; height: 40pt;"
                data-lax-preset="spinRev-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.3 fadeInOut">
            <div class="lax block"
                style="background: #EDD943; margin-top: 100pt; margin-left: -60pt; width: 25pt; height: 25pt;"
                data-lax-preset="spin-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.05 fadeInOut">
            <div class="lax block" style="background: #ED2471; margin-top: -30pt; margin-left: -70pt;"
                data-lax-preset="spin"></div>
        </div>

        <h3 data-lax-preset="leftToRight-0.8 speedy" data-lax-optimize=true class="lax chunkyText" style="
        color: #white; position: absolute; margin-top: -20pt; margin-left: -100pt">
            C'est une menace ?
        </h3>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.15 fadeInOut">
            <div class="lax block"
                style="background: #35D5E5; margin-top: -70pt; margin-left: -20pt; width: 40pt; height: 40pt;"
                data-lax-preset="spinRev-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.45 fadeInOut">
            <div class="lax block"
                style="background: #ED2471; margin-top: -50pt; margin-left: -50pt; width: 25pt; height: 25pt;"
                data-lax-preset="spin-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.5 fadeInOut">
            <div class="lax block" style="background: #35D5E5; margin-top: 30pt; margin-left: -20pt;"
                data-lax-preset="spinRev-500"></div>
        </div>

        <div class="lax blockContainer" data-lax-preset="leftToRight-1.25 fadeInOut">
            <div class="lax block" style="background: #ED2471; margin-top: 80pt; margin-left: -10pt;"
                data-lax-preset="spin-500"></div>
        </div>
    </div>

    <div id="section3" class="lax section">
        <p class="lax" data-lax-preset="linger" data-lax-optimize=true>
            Rendez nous Bouillot!
        </p>
    </div>



</div>
<script type="text/javascript" src="js/scriptLax.js" ></script>

<?php
include "./footer.php";
?>