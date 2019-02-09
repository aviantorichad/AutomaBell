<style>

    ul{
        width:200px;
        list-style:none;
        box-shadow:0 0 2px #555;
        float:left;
    }
    li{
        float:left;
        padding:5px;
    }
    li:hover{
        background:#f0f0f0;
        cursor:pointer;
    }
</style>
<script type="text/javascript">
    function setJam(injam) {
        var jam = injam;
        try {
            document.getElementById("in_time").value = jam;
        } catch (exo) {
            alert(exo)
        }
    }
</script>
<input type="text" id="in_time" />
<br/>
<ul>
    <li onclick="setJam(this.innerHTML)">00:00</li>
    <li onclick="setJam(this.innerHTML)">01:00</li>
    <li onclick="setJam(this.innerHTML)">02:00</li>
    <li onclick="setJam(this.innerHTML)">03:00</li>
    <li onclick="setJam(this.innerHTML)">04:00</li>
    <li onclick="setJam(this.innerHTML)">05:00</li>
    <li onclick="setJam(this.innerHTML)">06:00</li>
    <li onclick="setJam(this.innerHTML)">07:00</li>
    <li onclick="setJam(this.innerHTML)">08:00</li>
    <li onclick="setJam(this.innerHTML)">09:00</li>
    <li onclick="setJam(this.innerHTML)">10:00</li>
    <li onclick="setJam(this.innerHTML)">11:00</li>
    <li onclick="setJam(this.innerHTML)">12:00</li>
    <li onclick="setJam(this.innerHTML)">13:00</li>
    <li onclick="setJam(this.innerHTML)">14:00</li>
    <li onclick="setJam(this.innerHTML)">15:00</li>
    <li onclick="setJam(this.innerHTML)">16:00</li>
    <li onclick="setJam(this.innerHTML)">17:00</li>
    <li onclick="setJam(this.innerHTML)">18:00</li>
    <li onclick="setJam(this.innerHTML)">19:00</li>
    <li onclick="setJam(this.innerHTML)">20:00</li>
    <li onclick="setJam(this.innerHTML)">21:00</li>
    <li onclick="setJam(this.innerHTML)">22:00</li>
    <li onclick="setJam(this.innerHTML)">23:00</li>
</ul>