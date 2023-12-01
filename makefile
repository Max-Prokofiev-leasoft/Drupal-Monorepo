BANKS := bank_example ems xpate core

.PHONY: check-changes $(BANKS) merge release

check-changes: $(BANKS)

$(BANKS):
	@if [ -n "$$(git -C $@ status -s)" ]; then \
        echo "Changes detected in $@, running Makefile..."; \
        $(MAKE) -C $@/script/merge; \
        $(MAKE) -C $@/script/release; \
    else \
        echo "No changes in $@."; \
    fi

merge release:
	@for bank in $(BANKS); do \
        echo "Running Makefile in $$bank/script/$@..."; \
        $(MAKE) -C $$bank/script/$@; \
    done
