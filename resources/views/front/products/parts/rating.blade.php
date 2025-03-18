<div class="progress">
    <span>{{ $rating_value }} звезды</span>
    <div class="progress-bar" role="progressbar"
         style="width: {{ round($percent, 1) }}%" aria-valuenow="{{ round($percent, 1) }}"
         aria-valuemin="0" aria-valuemax="100">{{ round($percent, 1) }}%</div>
</div>