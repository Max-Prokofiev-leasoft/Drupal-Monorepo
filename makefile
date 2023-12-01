.PHONY: check-changes

check-changes:
	@if [ -z "$$(git status -s)" ]; then \
		echo "No changes detected."; \
	else \
		echo "Changes detected. Running Makefiles for modified directories..."; \
		$(MAKE) run-makefiles; \
	fi

run-makefiles:
	@echo "Running Makefiles in modified directories...";
	@for dir in $$(git diff --name-only HEAD^ HEAD | grep -E 'bank_example|ems|xpate|core' | sed 's|/.*||' | sort -u); do \
		$(MAKE) -C $$dir; \
	done
