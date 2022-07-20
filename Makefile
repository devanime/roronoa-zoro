.PHONY: *

build:
	@[ -d node_modules ] || yarn install
	@gulp
	@git add -A .

watch:
	@gulp watch

clean:
	@find ./* -type d -name "dist" -prune -exec rm -rf {} \;
	@rm -rf node_modules
