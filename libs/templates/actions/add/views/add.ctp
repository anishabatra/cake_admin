<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2009, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<div class="<?php echo $pluralVar;?> form">
<h2><?php printf("<?php __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></h2>
<?php echo "<?php echo \$this->Form->create('{$modelClass}', array('url' => array(
	'plugin' => '{$admin->plugin}', 'controller' => '{$controllerRoute}', 'action' => '{$action}')));?>\n";?>
<?php foreach ($configuration['config'] as $i => $config): ?>
	<fieldset<?php if (!empty($config['classes'])) echo ' class="' . $config['classes'] . '"'; ?>>
<?php if (!empty($config['title'])) : ?>
 		<legend><?php printf("<?php __('%s'); ?>", $config['title']); ?></legend>
<?php endif; ?>
<?php if (!empty($config['description'])) : ?>
		<p><?php printf("<?php __('%s'); ?>", $config['description']); ?></p><br />
<?php endif; ?>
<?php
		echo "\t\t<?php\n";
		foreach ($config['fields'] as $field => $fieldConfig) {
			$options = array();
			if (!empty($fieldConfig)) {
				foreach ($fieldConfig as $key => $value) {
					$options[] = "'{$key}' => '$value'";
				}
				if (in_array($field, $config['readonly'])) {
					$options[] = "disabled";
				}
			}
			$options = (empty($options)) ? '' : ", array(" . implode(', ', $options). ")";
			echo "\t\t\techo \$this->Form->input('{$field}'{$options});\n";
		}
		echo "\t\t?>\n";
?>
	</fieldset>
<?php endforeach; ?>
<?php
if ($config['habtm'] === true && !empty($associations['hasAndBelongsToMany'])) {
	echo "\t<fieldset>";
	foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
		echo "\t\t<?php echo \$this->Form->input('{$assocName}'); ?>\n";
	}
	echo "\t</fieldset";
}
?>
<?php
	echo "<?php echo \$this->Form->end(__('Submit', true));?>\n";
?>
</div>
<div class="actions">
	<h3><?php echo "<?php __('Actions'); ?>"; ?></h3>
	<ul>

<?php if (strpos($action, 'add') === false): ?>
		<li><?php echo "<?php echo \$this->Html->link(__('Delete', true), array('action' => 'delete', \$this->Form->value('{$modelClass}.{$primaryKey}')), null, sprintf(__('Are you sure you want to delete # %s?', true), \$this->Form->value('{$modelClass}.{$primaryKey}'))); ?>";?></li>
<?php endif;?>
		<li><?php echo "<?php echo \$this->Html->link(__('List " . $pluralHumanName . "', true), array('action' => 'index'));?>";?></li>
	</ul>
</div>