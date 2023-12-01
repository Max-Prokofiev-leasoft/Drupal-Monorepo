BANKS := ems xpate

.PHONY: check-changes

check-changes:
	@for bank in $(BANKS); do \
        if [ -n "$$(git -C $$bank status -s)" ]; then \
            echo "Changes detected in $$bank, running Makefile..."; \
            $(MAKE) -C $$bank; \
        else \
            echo "No changes in $$bank."; \
        fi; \
    done
