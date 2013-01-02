Silex Bulletin Board Styles
===========================

stuff

info.xml
--------

Contains information about your style

```xml
<style>
	<!-- information about your style -->
	<info>
		<name><!-- Give it a name --></name>
		<description><!-- descripe it --></description>
		<thumbnail><!-- a tiny screenshot --></thumbnail>
		<author><!-- Your name --></author>
		<website><!-- your website --></website>
		<license><!-- I dare you to use an open source one --></license>
		<version><!-- beta all the things --></version>
	</info>
	<!-- fancy stuff (everything is optional) -->
	<properties>
		<script><!-- a php file called by Style.class (optional) --></script>
		<!-- Below will be ignored if a script is set -->
		<order>
			<css>
				<!-- an ordered list of css and/or css-compiler <file>s -->
				<!-- css-compilers are php files wich print css code -->
			</css>
			<js>
				<!-- same shit as css but with js -->
			</js>
		</order>
	</properties>
</style>
```