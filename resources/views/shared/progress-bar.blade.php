<span class="header">Your Pin Progress</span>

<div class="progressBar">
    <div class="userProgress" style="width: {{ $progressPercentage }}%; background-color: {{ $progressPercentage === 100 ? 'green' : 'rgb(145, 145, 145)' }};">
    </div>
</div>

<div style="text-align: center;">
    <span id="progressText">
        {{ $userPinsCount }} / {{ $totalPins }}
    </span>
</div>