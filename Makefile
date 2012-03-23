SHELL:=/bin/bash

initialize:
	@# Update all of the submodules
	@git submodule update --init --recursive
