BANKS := bank_example ems xpate core
TARGETS := merge release

.PHONY: check-changes $(BANKS) $(foreach bank,$(BANKS),$(TARGETS))

check-changes: $(BANKS)

$(BANKS):
	@if [ -n "$$(git -C $@ status -s)" ]; then \
        echo "Changes detected in $@, running Makefile..."; \
        $(MAKE) -C $@/script/merge; \
        $(MAKE) -C $@/script/release; \
    else \
        echo "No changes in $@."; \
    fi

$(foreach bank,$(BANKS),$(TARGETS)):
	@echo "Running Makefile in $(bank)/script/$@...";
	@$(MAKE) -C $(bank)/script/$@;
