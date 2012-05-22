{% macro step_bar(steps, current_step, id) %}
    <div class="step_bar"{{ id ? (' id="' ~ id ~ '"') : '' }}>
		<style type="text/css">
			{{ id ? ('#' ~ id) : ''}}.step_bar .step_bullet_wrap { margin-right: {{ 100 / (steps - 1) }}%; } /* 100 / num of steps - 1 */
			{% if id %}
				{{ '#' ~ id }}.step_bar .step_bullet_wrap:last-child { margin: 0; }
			{% endif %}
		</style>
		{% for i in 1..steps %}
			<div class="step_bullet_wrap{{ i < current_step ? ' done' : (i == current_step ? ' current' : '') }}">
				<div class="step_bullet">{{ i }}</div>
			</div>
		{% endfor %}
	</div>
{% endmacro %}

{% macro progress_bar(percent, extra_class, id) %}
	<style type="text/css">
		{{ id ? ('#' ~ id) : ''}}.container_progress .progress { width: {{ percent }}%; } /* Current Progress */
	</style>
	<div class="container_progress{{ extra_class ? (' ' ~ extra_class) : '' }}"{{ id ? (' id="' ~ id ~ '"') : '' }}>
		<div class="progress_bar">
			<div class="progress"></div>
		</div>
	</div>
{% endmacro %}