.PHONY: release-all
release-all: release-ems release-xpate
	@echo "All releases completed."

.PHONY: release-ems
release-ems:
	@echo "Releasing EMS..."
	cd ems && cd script && make -f replacer && make -f builder && make -f release

.PHONY: release-xpate
release-xpate:
	@echo "Releasing XPate..."
	cd xpate && cd script && make -f replacer && make -f builder && make -f release
