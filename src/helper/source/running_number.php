<script>
    function updateCounter(countElement, totalValue) {
        var count = parseInt(countElement.innerHTML);
        var interval = setInterval(function() {
            if (count < totalValue) {
                count++;
                countElement.innerHTML = count;
            } else if (count > totalValue) {
                count--;
                countElement.innerHTML = count;
            } else {
                clearInterval(interval);
                countElement.classList.remove('count-running');
            }
        }, 50);
    }
    
    var total1 = <?php echo $total1; ?>;
    var total2 = <?php echo $total2; ?>;
    var total3 = <?php echo $total3; ?>;
    var total4 = <?php echo $total4; ?>;

    window.onload = function() {
        var runningNumber1 = document.getElementById('runningNumber1');
        updateCounter(runningNumber1, total1);

        var runningNumber2 = document.getElementById('runningNumber2');
        updateCounter(runningNumber2, total2);

        var runningNumber3 = document.getElementById('runningNumber3');
        updateCounter(runningNumber3, total3);

        var runningNumber4 = document.getElementById('runningNumber4');
        updateCounter(runningNumber4, total4);
    };
</script>