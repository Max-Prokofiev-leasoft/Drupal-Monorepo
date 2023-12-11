.PHONY: release-all
release-all: release-example release-ems release-xpate
	@echo "All releases completed."

.PHONY: release-example
release-example:
	@echo "Releasing example..."
	cd bank_example && cd script && make -f builder && make -f release

.PHONY: release-ems
release-ems:
	@echo "Releasing EMS..."
	cd ems && cd script && make -f builder && make -f release

.PHONY: release-xpate
release-xpate:
	@echo "Releasing XPate..."
	cd xpate && cd script && make -f builder && make -f release
