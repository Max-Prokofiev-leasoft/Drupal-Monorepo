BANKS := bank_example ems xpate core
TARGETS := merge release

.PHONY: check-changes $(BANKS)

check-changes: $(BANKS)

$(BANKS):
	@if [ -n "$$(git -C $@ status -s)" ]; then \
        echo "Changes detected in $@, running Makefile..."; \
        $(MAKE) -C $@/script/merge; \
        $(MAKE) -C $@/script/release; \
    else \
        echo "No changes in $@."; \
    fi

$(foreach bank,$(BANKS),$(foreach target,$(TARGETS),$(bank)_$(target))):
	@echo "Running Makefile in $(subst _,/script/,$@)...";
	@$(MAKE) -C $(subst _,/script/,$@);

merge release: $(foreach bank,$(BANKS),$(foreach target,$(TARGETS),$(bank)_$(target)))
