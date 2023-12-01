BANKS := bank_example ems xpate core

.PHONY: check-changes $(BANKS)

check-changes: $(BANKS)

$(BANKS):
	@if [ -n "$$(git -C $@ status -s)" ]; then \
        echo "Changes detected in $@, running Makefile..."; \
        $(MAKE) -C $@/script/merge; \
    else \
        echo "No changes in $@."; \
    fi
