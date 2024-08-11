function showHideTooltip(tooltip, message) {
	// Mostrar el tooltip
	tooltip.textContent = message;
	tooltip.style.visibility = 'visible';
	tooltip.style.opacity = '1';

	// Ocultar después de 3 segundos
	setTimeout(() => {
		tooltip.style.visibility = 'hidden';
		tooltip.style.opacity = '0';
	}, 3000);
}
